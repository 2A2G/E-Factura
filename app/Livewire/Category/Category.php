<?php

namespace App\Livewire\Category;

use App\Models\TypeProduct;
use Livewire\Component;

class Category extends Component
{
    public $type_products;
    public function mount()
    {
        $this->type_products = TypeProduct::all();
    }
    public function render()
    {
        return view('livewire.category.category');
    }
}
