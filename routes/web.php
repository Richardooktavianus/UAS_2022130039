<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PenyewaanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('kamar', KamarController::class);


Route::resource('penghuni', PenghuniController::class);

Route::resource('penyewaan', PenyewaanController::class);

Route::resource('pembayaran', PembayaranController::class);


