<?php

namespace App\Livewire\Billing;

use App\Models\Bill;
use App\Models\Order;
use Livewire\Component;

class CreateFacture extends Component
{
    public $purchases;
    public $totalAmount;
    public $averagePurchase;

    public function mount()
    {
        $this->purchases = Bill::withTrashed()->get();
        $this->totalAmount = Order::withTrashed()->sum('total_price');
        $totalOrders = Order::withTrashed()->count();

        $this->averagePurchase = $totalOrders > 0 ? $this->totalAmount / $totalOrders : 0;
    }
    public function render()
    {
        return view('livewire.billing.create-facture');
    }
}
