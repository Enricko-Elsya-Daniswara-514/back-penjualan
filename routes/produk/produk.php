<?php

use App\Http\Controllers\Produk\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/produk', [ProdukController::class, 'getproduk']);
Route::post('/simpanproduk', [ProdukController::class, 'simpan']);




