<?php
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProdukController::class, 'landing'])
       ->name('landing');


Route::resource('produk', ProdukController::class)
       ->except(['show'])
       ->parameters(['produk'=> 'produk']);