<?php

namespace App\Livewire\Category;

use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Mockery\Matcher\Type;

class Category extends Component
{
    public $typeProducts;
    public $typeProduct;
    public $totalProduct;
    public $openCategory = false;
    public $openDeleteCategory = false;
    public $openUpdateCategory = false;
    public $product_type_name;

    public function clearInputs()
    {
        $this->product_type_name;
        $this->typeProduct;
    }

    public function mount()
    {
        $this->typeProducts = TypeProduct::withTrashed()->get();
        $this->totalProduct = Product::withTrashed()->get();
    }

    public function openModalCategory()
    {
        $this->openCategory = true;
    }

    public function openModalDeleteCategory($id_typeProdct)
    {
        $this->typeProduct = TypeProduct::withTrashed()->find($id_typeProdct);
        $this->openDeleteCategory = true;
    }

    public function openModalUpdateCategory($id_typeProdct)
    {
        $this->typeProduct = TypeProduct::withTrashed()->find($id_typeProdct);
        $this->product_type_name = $this->typeProduct->product_type_name;
        $this->openUpdateCategory = true;

    }

    public function store()
    {
        try {
            $this->validate(
                [
                    'product_type_name' => 'required',
                ]
            );

            $typeProduct = new TypeProduct();
            $typeProduct->product_type_name = $this->product_type_name;
            $typeProduct->save();

            $this->dispatch('post-created', name: "La categoria " . $this->product_type_name . ", se ha creado satisfactoriamente");

            $this->clearInputs();
            $this->openCategory = false;

            $this->mount();
        } catch (\Throwable $th) {
            $this->openCategory = false;
            $this->dispatch('post-error', name: "Error al registrar la categoria. inténtelo de nuevo");
            $this->clearInputs();
            throw $th;
        }
    }

    public function update()
    {
        $this->openUpdateCategory = true;

    }

    public function delete()
    {
        try {
            $this->typeProduct->delete();

            $this->openDeleteCategory = false;
            $this->dispatch('post-deleted', name: "Se ha eliminado satisfactoriamente la categoría");

            $this->clearInputs();
            $this->mount();

        } catch (\Throwable $th) {
            $this->dispatch('post-deleted', name: "Hubo un error al eliminar la categoría: " . $th->getMessage());
            Log::error('Error al eliminar categoría: ' . $th->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.category.category');
    }
}

