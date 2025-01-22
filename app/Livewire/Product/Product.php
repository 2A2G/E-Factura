<?php

namespace App\Livewire\Product;

use App\Models\Product as ModelsProduct;
use Livewire\Component;
class Product extends Component
{
    public $products;
    public $productExhausted;


    public function mount()
    {
        $this->products = ModelsProduct::withTrashed()->get();
        $this->productExhausted = ModelsProduct::where('quantity_products', 0)->count();
    }

    public function clearInputs()
    {

    }
    public function openModal()
    {

    }
    public function render()
    {
        return view('livewire.product.product');
    }
}
