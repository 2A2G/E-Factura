<?php

namespace App\Livewire\Client;

use App\Models\Client as ModelsClient;
use App\Models\Order;
use Livewire\Component;

class Client extends Component
{

    public $clients;
    public $totalOrder;


    public function mount()
    {
        $this->clients = ModelsClient::all();
        $this->totalOrder = Order::all();
    }

    public function render()
    {
        return view('livewire.client.client');
    }
}
