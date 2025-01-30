<?php

namespace App\Livewire\Category;

use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Mockery\Matcher\Type;

class Category extends Component
{
    public $typeProduct;
    public $totalProduct;
    public $totalTypeProduct;
    public $typeProductActive;
    public $openCategory = false;
    public $openDeleteCategory = false;
    public $openUpdateCategory = false;
    public $product_type_name;
    public $estado = '';

    public function clearInputs()
    {
        $this->mount();
        $this->openCategory = false;
        $this->openDeleteCategory = false;
        $this->openUpdateCategory = false;
        $this->product_type_name = null;
        $this->typeProduct = null;
        $this->estado = '';
    }

    public function mount()
    {
        $this->totalProduct = Product::withTrashed()->get();
        $this->totalTypeProduct = TypeProduct::withTrashed()->get();
        $this->typeProductActive = TypeProduct::whereNull('deleted_at')->count();
    }

    public function openModalCategory()
    {
        $this->clearInputs();
        $this->openCategory = true;
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

        } catch (\Throwable $th) {
            $this->openCategory = false;
            $this->dispatch('post-error', name: "Error al registrar la categoria. inténtelo de nuevo");
            $this->clearInputs();
            throw $th;
        }
    }

    public function openModalUpdateCategory($id_typeProdct)
    {
        $this->clearInputs();
        $this->typeProduct = TypeProduct::withTrashed()->where('id', $id_typeProdct)->first();

        if ($this->typeProduct) {
            $this->product_type_name = $this->typeProduct->product_type_name;
            $this->estado = $this->typeProduct->trashed() ? 'Eliminado' : 'Activo';
            $this->openUpdateCategory = true;
        } else {
            $this->estado = '';
            $this->openUpdateCategory = false;
        }
    }

    public function update()
    {
        try {
            $this->validate([
                'product_type_name' => 'required|string|max:255',
            ]);

            $typeProduct = TypeProduct::withTrashed()->where('id', $this->typeProduct->id)->first();

            if (!$typeProduct) {
                $this->openUpdateCategory = false;
                $this->dispatch('post-error', name: "No se encontró el registro de la categoría, inténtelo nuevamente.");
                $this->clearInputs();
                return;
            }

            if ($this->estado == "Eliminado") {
                $typeProduct->delete();
            } else {
                $typeProduct->restore();
            }

            $typeProduct->update([
                'product_type_name' => $this->product_type_name,
            ]);

            $this->clearInputs();
            $this->dispatch('post-update', name: "La categoría " . $this->product_type_name . " se ha actualizado con éxito.");

        } catch (\Throwable $th) {
            $this->openUpdateCategory = false;
            $this->clearInputs();
            $this->dispatch('post-error', name: "Hubo un error al intentar actualizar la categoría. Inténtelo de nuevo.");
            Log::error('Error al actualizar categoría: ' . $th->getMessage());
        }
    }

    public function openModalDeleteCategory($id_typeProdct)
    {
        $this->clearInputs();
        $this->typeProduct = TypeProduct::withTrashed()->find($id_typeProdct);
        $this->openDeleteCategory = true;
    }

    public function delete()
    {
        try {
            $this->typeProduct->delete();

            $this->openDeleteCategory = false;
            $this->dispatch('post-deleted', name: "Se ha eliminado satisfactoriamente la categoría");

            $this->clearInputs();

        } catch (\Throwable $th) {
            $this->clearInputs();
            $this->dispatch('post-deleted', name: "Hubo un error al eliminar la categoría: " . $th->getMessage());
            Log::error('Error al eliminar categoría: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.category.category', [
            'typeProducts' => TypeProduct::withTrashed()->paginate(10),
        ]);
    }
}

