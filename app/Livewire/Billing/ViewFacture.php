<?php

namespace App\Livewire\Billing;

use App\Http\Controllers\ApiController;
use Livewire\Component;

class ViewFacture extends Component
{
    public $dataFactures;
    public $pagination;

    public function mount()
    {
        $apiController = app()->make(ApiController::class);
        $response = $apiController->getFacture();
        $data = $response->getData(true);
        $this->dataFactures = $data['data']['data']['data'];
        $this->pagination = $data['data']['data']['pagination'];
    }

    public function render()
    {
        return view('livewire.billing.view-facture');
    }
}


