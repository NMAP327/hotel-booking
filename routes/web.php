<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DetailTransactionController;

// Route untuk halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk autentikasi
Route::middleware(['auth'])->group(function () {
    // Route untuk Master Room
    Route::resource('rooms', RoomController::class)->except(['show']);

    // Route untuk Room Type
    Route::resource('room-types', RoomTypeController::class)->except(['show']);

    // Route untuk Transaksi
    Route::resource('transactions', TransactionController::class)->except(['show']);

    // Route untuk Detail Transaksi
    Route::resource('detail-transactions', DetailTransactionController::class)->except(['show']);
});

// Route untuk autentikasi dan hak akses admin
Route::middleware(['auth', 'admin'])->group(function () {
    // Route untuk Fitur Laporan
    Route::get('/report', [TransactionController::class, 'report'])->name('transaction.report');;
});

// Route untuk autentikasi Laravel
require __DIR__.'/auth.php';


Route::post('/booking', [TransactionController::class, 'store'])->name('transaction.store');

