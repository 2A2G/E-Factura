<?php

namespace App\Livewire\Client;

use App\Models\Client as ModelsClient;
use Livewire\Component;

class Client extends Component
{

    public $clients;


    public function mount()
    {
        $this->clients = ModelsClient::all();
    }

    public function render()
    {
        return view('livewire.client.client');
    }
}
