<?php

use App\Http\Controllers\ApiController;
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



    Route::get('/auth-api', [ApiController::class, 'authenticate']);
});


