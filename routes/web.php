<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\FactureController;
use App\Livewire\Client\ClientController as ClientClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('Efactura')->middleware(['auth:sanctum'])->group(function () {
    Route::get('client', function () {
        return view('module.client.client');
    })->name('indexClient');

    Route::get('catagory', function () {
        return view('module.category.category');
    })->name('indexCatagory');

    Route::get('product', function () {
        return view('module.product.product');
    })->name('indexProduct');

    Route::get('shopping', function () {
        return view('module.billing.create');
    })->name('indexShopping');

    Route::get('factures', function () {
        return view('module.billing.view');
    })->name('indexFacture');

    Route::get('/generate/{id}', [FactureController::class, 'generatePDF'])->name('viewFacture');


    //Consumiendo las API'S

    Route::get('/auth-api', [ApiController::class, 'authenticate']);
    Route::get('/sendFacture/{facture_id}', [ApiController::class, 'sendFacture'])->name('sendFacture');
    Route::get('/getFacture', [ApiController::class, 'getFacture'])->name('getFacture');
    Route::get('/searchFacture/{numerReference}', [ApiController::class, 'searchFacture'])->name('searchFacture');


});


