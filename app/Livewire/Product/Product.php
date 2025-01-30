<?php

namespace App\Livewire\Product;

use App\Models\Product as ModelsProduct;
use App\Models\TypeProduct;
use Livewire\Component;
use Symfony\Contracts\Service\Attribute\Required;

class Product extends Component
{
    public $typeProducts;
    public $productD;
    public $productExhausted;
    public $type_products_id;
    public $code_product;
    public $name_product;
    public $price_product;
    public $quantity_products;
    public $openProduct = false;
    public $openUpdate = false;
    public $openDelete = false;
    public $estado = '';

    public function mount()
    {
        $this->productExhausted = ModelsProduct::where('quantity_products', 0)->count();
        $this->productD = ModelsProduct::withTrashed()->count();
        $this->typeProducts = TypeProduct::all();
    }

    public function clearInputs()
    {
        $this->mount();
        $this->openProduct = false;
        $this->openUpdate = false;
        $this->openDelete = false;

        $this->type_products_id = null;
        $this->code_product = null;
        $this->name_product = null;
        $this->price_product = null;
        $this->quantity_products = null;
        $this->estado = '';
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
                'code_product' => 'required|max:10',
                'name_product' => 'required|string|max:255',
                'price_product' => 'required|integer|min:0',
                'quantity_products' => 'required|integer|min:0',
            ]);

            ModelsProduct::create([
                'type_products_id' => $this->type_products_id,
                'code_product' => $this->code_product,
                'name_product' => $this->name_product,
                'price_product' => $this->price_product,
                'quantity_products' => $this->quantity_products,
            ]);

            $this->dispatch('post-created', name: "Se ha registrado el producto " . $this->name_product . ", exitosamente");
            $this->clearInputs();

        } catch (\Throwable $th) {
            $this->clearInputs();
            $this->dispatch('post-error', name: "Hubo un error al registrar el producto. Intentelo nuevamente " . $th->getMessage());
        }
    }

    public function openUpdateProduct($code_product)
    {
        try {
            $product = ModelsProduct::withTrashed()->where('code_product', $code_product)->first();

            if (!$product) {
                $this->dispatch('post-error', name: "Error: Producto con código $code_product no encontrado. Inténtelo nuevamente.");
                $this->clearInputs();
                return;
            }

            $this->type_products_id = $product->type_products_id;
            $this->code_product = $product->code_product;
            $this->name_product = $product->name_product;
            $this->price_product = $product->price_product;
            $this->quantity_products = $product->quantity_products;

            $this->estado = $product->trashed() ? 'Eliminado' : 'Activo';
            $this->openUpdate = true;

        } catch (\Throwable $th) {
            $this->dispatch('post-error', name: "Error al cargar el producto con código $code_product. Inténtelo nuevamente.");
            $this->clearInputs();
            throw $th;
        }
    }

    public function update()
    {
        try {
            $this->validate([
                'type_products_id' => 'required|integer',
                'code_product' => 'required',
                'name_product' => 'required|string|max:255',
                'price_product' => 'required|integer|min:0',
                'quantity_products' => 'required|integer|min:0',
            ]);

            $product = ModelsProduct::withTrashed()->where('code_product', $this->code_product)->first();

            if (!$product) {
                $this->dispatch('post-warning', name: "Error: Producto con código $this->code_product no encontrado. Inténtelo nuevamente.");
                $this->clearInputs();
                return;
            }

            $product->update([
                'type_products_id' => $this->type_products_id,
                'code_product' => $this->code_product,
                'name_product' => $this->name_product,
                'price_product' => $this->price_product,
                'quantity_products' => $this->quantity_products,
            ]);

            if ($this->estado == "Eliminado") {
                $product->delete();
            } else {
                $product->restore();
            }

            $this->dispatch('post-created', name: "El producto " . $this->code_product . ", ha sido actualizado exitosamente");
            $this->clearInputs();


        } catch (\Throwable $th) {
            $this->dispatch('post-error', name: "Hubo un error al actualizar el producto " . $this->code_product . ". Intentelo nuevamente");
            $this->clearInputs();
            throw $th;
        }
    }

    public function openDeleteCategory($code_product)
    {
        try {
            $product = ModelsProduct::withTrashed()->where('code_product', $code_product)->first();

            if (!$product) {
                $this->dispatch('post-error', name: "Error: Producto con código $code_product no encontrado. Inténtelo nuevamente.");
                $this->clearInputs();
                return;
            }

            $this->openDelete = true;
            $this->code_product = $product->code_product;

        } catch (\Throwable $th) {
            $this->dispatch('post-error', name: "Error al cargar el producto con código $code_product. Inténtelo nuevamente.");
            $this->clearInputs();
            throw $th;
        }
    }

    public function delete()
    {
        try {
            $product = ModelsProduct::where('code_product', $this->code_product)->first();

            if (!$product) {
                $this->dispatch('post-error', name: "Error: Producto con código $this->code_product no encontrado. Inténtelo nuevamente.");
                $this->clearInputs();
                return;
            }
            $product->delete();
            $this->clearInputs();
            $this->dispatch('post-created', name: "El producto se ha eliminado correctamente");

        } catch (\Throwable $th) {
            $this->dispatch('post-error', name: "Error al cargar el producto con código $this->code_product. Inténtelo nuevamente.");
            $this->clearInputs();
            throw $th;
        }

    }

    public function render()
    {
        return view('livewire.product.product', [
            'products' => ModelsProduct::withTrashed()->paginate(10),
        ]);
    }
}
