<?php

namespace App\Livewire\Billing;

use App\Models\Bill;
use App\Models\Client;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateFacture extends Component
{
    public $type_identity = '';
    public $number_identity;
    public $email_client;
    public $name_client;
    public $phone_client;
    public $address_client;

    public $step = 1;
    public $currentStep = 1;
    public $totalAmount;
    public $averagePurchase;
    public $openPurchase = false;

    public $products;
    public $selectedProduct = null;
    public $quantities = 0;
    public $quantity = 0;

    public $cart = [];
    public $searchQuery;
    public $searchResults = [];
    public $totalCartAmount = 0;

    public $payment_method = '';
    public $bank_type = '';
    public $credit_card_type = '';

    public $banks = [
        'Bancolombia',
        'Nequi',
        'Falabella',
        'Davivienda',
        'BBVA',
        'Banco de Bogotá'
    ];

    public function mount()
    {
        $this->totalAmount = Order::withTrashed()->sum('total_price');
        $totalOrders = Order::withTrashed()->count();
        $this->averagePurchase = $totalOrders > 0 ? $this->totalAmount / $totalOrders : 0;
        $this->products = Product::all();
    }

    public function clearInputs()
    {
        $this->reset([
            'type_identity',
            'number_identity',
            'email_client',
            'name_client',
            'phone_client',
            'address_client',
            'currentStep',
        ]);
        $this->openPurchase = false;
    }

    public function openCreatePurchase()
    {
        $this->clearInputs();
        $this->openPurchase = true;
    }

    public function nextStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'type_identity' => 'required|string|max:50',
                'number_identity' => 'required|string|max:20',
                'email_client' => 'required|email',
                'name_client' => 'required|string|max:100',
                'phone_client' => 'required|string|max:15',
                'address_client' => 'nullable|string|max:200',
            ]);
        }
        if ($this->currentStep == 2) {
            if ($this->cart == null) {
                $this->dispatch('post-warning', name: 'La cantidad ingresada no es disponible. Debe seleccionar al menos un producto');
                return;
            }
        }

        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function searchProduct()
    {
        if (!empty($this->searchQuery)) {
            $this->searchResults = Product::where('code_product', 'like', '%' . $this->searchQuery . '%')
                ->orWhere('name_product', 'like', '%' . $this->searchQuery . '%')
                ->get()
                ->toArray();
        } else {
            $this->searchResults = [];
        }
    }

    public function addProduct($productId)
    {
        $product = Product::find($productId);
        if ($this->quantities == 0) {
            $this->dispatch('post-warning', name: 'La cantidad ingresada no es disponible. Debe ser haber al menos un producto');
            return;
        } elseif ($this->quantities > $product->quantity_products) {
            $this->dispatch('post-warning', name: 'La cantidad ingresada supera la cantidad disponible en el estante.');
            return;
        }

        $totalPrice = $product->price_product * $this->quantities;

        $this->cart[$productId] = [
            'id' => $product->id,
            'code_product' => $product->code_product,
            'name_product' => $product->name_product,
            'price_product' => $product->price_product,
            'quantity' => $this->quantities,
            'total' => $totalPrice,
        ];

        $this->updateTotal();
        $this->searchResults = [];
        $this->searchQuery = '';
        $this->quantities = 1;
    }

    public function removeFromCart($productId)
    {
        $this->cart = array_filter($this->cart, function ($item) use ($productId) {
            return $item['id'] !== $productId;
        });

        $this->calculateTotalCartAmount();
    }

    public function calculateTotalCartAmount()
    {
        $this->totalCartAmount = array_sum(array_column($this->cart, 'total'));
    }

    private function updateTotal()
    {
        $this->totalCartAmount = array_sum(array_column($this->cart, 'total'));
    }

    public function store()
    {
        try {
            $this->validate([
                'payment_method' => 'required|string',
                'bank_type' => 'required_if:payment_method,tarjeta|string',
                'credit_card_type' => 'required_if:payment_method,tarjeta|string',
            ]);

            DB::transaction(function () {
                try {
                    // Crear y guardar el cliente
                    $newClient = new Client();
                    $newClient->type_identity = $this->type_identity;
                    $newClient->number_identity = $this->number_identity;
                    $newClient->email_client = $this->email_client;
                    $newClient->name_client = $this->name_client;
                    $newClient->phone_client = $this->phone_client;
                    $newClient->address_client = $this->address_client;

                    if (!$newClient->save()) {
                        throw new \Exception("Error al guardar el cliente.");
                    }

                    $newBill = new Bill();
                    $newBill->client_id = $newClient->id;

                    if (!$newBill->save()) {
                        throw new \Exception("Error al guardar la factura.");
                    }

                    foreach ($this->cart as $cartItem) {
                        $newOrder = new Order();
                        $newOrder->bill_id = $newBill->id;
                        $newOrder->product_id = $cartItem['id'];
                        $newOrder->amount = $cartItem['quantity'];
                        $newOrder->total_price = $cartItem['total'];

                        if (!$newOrder->save()) {
                            throw new \Exception("Error al guardar el pedido.");
                        }
                    }

                    $newPaymentMethod = new PaymentMethod();
                    $newPaymentMethod->bill_id = $newBill->id;
                    $newPaymentMethod->payment_method = $this->payment_method;
                    $newPaymentMethod->bank_type = $this->bank_type;
                    $newPaymentMethod->credit_card_type = $this->credit_card_type;

                    if (!$newPaymentMethod->save()) {
                        throw new \Exception("Error al guardar el método de pago.");
                    }

                    $this->dispatch('post-created', name: "Compra realizada con éxito");
                } catch (\Throwable $th) {
                    $this->dispatch('post-error', name: "Hubo un error al crear la compra: " . $th->getMessage());
                    throw $th;
                }
            });
        } catch (\Throwable $th) {
            $this->dispatch('post-error', name: "Hubo un error en la transacción general: " . $th->getMessage());
            throw $th;
        }
    }
    public function render()
    {
        return view('livewire.billing.create-facture', [
            'purchases' => Bill::withTrashed()->paginate(10),
        ]);
    }
}
