<?php

use App\Http\Controllers\Pegawai\PegawaiController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')
// ->group(function () {
//     Route::get('/pegawai', [PegawaiController::class, 'getpegawai']);
// });

Route::get('/pegawai', [PegawaiController::class, 'getpegawai']);

