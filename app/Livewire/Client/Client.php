<?php

namespace App\Livewire\Client;

use App\Models\Bill;
use App\Models\Client as ModelsClient;
use App\Models\Order;
use Livewire\Component;

class Client extends Component
{

    public $clients;
    public $totalOrder;


    public function mount()
    {
        $this->clients = ModelsClient::with('orders')->get();
        $this->totalOrder = Bill::all();

        foreach ($this->clients as $client) {
            $client->total_purchase_value = $client->orders->sum('total_price');
        }
    }




    public function render()
    {
        return view('livewire.client.client');
    }
}
