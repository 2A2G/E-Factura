<?php

namespace App\Livewire\Product;

use App\Models\Product as ModelsProduct;
use App\Models\TypeProduct;
use Livewire\Component;
use Symfony\Contracts\Service\Attribute\Required;

class Product extends Component
{
    public $products;
    public $typeProducts;
    public $productExhausted;
    public $type_products_id;
    public $code_product;
    public $name_product;
    public $price_product;
    public $quantity_products;
    public $openProduct = false;

    public function mount()
    {
        $this->products = ModelsProduct::withTrashed()->get();
        $this->productExhausted = ModelsProduct::where('quantity_products', 0)->count();
        $this->typeProducts = TypeProduct::all();
    }

    public function clearInputs()
    {
        $this->mount();
        $this->openProduct = false;
        $this->type_products_id = null;
        $this->code_product = null;
        $this->name_product = null;
        $this->price_product = null;
        $this->quantity_products = null;

    }
    public function openCreateProduct()
    {
        $this->openProduct = true;
    }

    public function store()
    {
        try {
            $this->validate([
                'type_products_id' => 'required|integer',
                'code_product' => 'required|regex:/^[A-Z0-9-]{8}$/',
                'name_product' => 'required|string|max:255',
                'price_product' => 'required|integer|min:0',
                'quantity_products' => 'required|integer|min:0',
            ]);

            $formattedCode = strtoupper(preg_replace('/[^A-Z0-9]/', '', $this->code_product));
            if (strlen($formattedCode) > 3) {
                $formattedCode = substr($formattedCode, 0, 3) . '-' . substr($formattedCode, 3, 4);
            }

            ModelsProduct::create([
                'type_products_id' => $this->type_products_id,
                'code_product' => $formattedCode,
                'name_product' => $this->name_product,
                'price_product' => $this->price_product,
                'quantity_products' => $this->quantity_products,
            ]);

            $this->dispatch('post-created', name: "Se ha registrado el producto " . $this->name_product . ", exitosamente");
            $this->clearInputs();

        } catch (\Throwable $th) {
            $this->clearInputs();

            $this->dispatch('post-error', name: "Hubo un error al registrar el producto. Intentelo nuevamente" . $th->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.product.product');
    }
}
