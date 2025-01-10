<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index'])->name('login');

// Route untuk login dan logout
Route::controller(AuthController::class)->group(function(){
    Route::get('login', 'index')->name('login');    // Halaman login
    Route::post('login', 'proses');                  // Proses login
    Route::get('logout', 'logout');                  // Logout
});

// Halaman Dashboard (Harus login untuk mengakses)


// Group routes yang memerlukan autentikasi
Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/generate-report', [ReportController::class, 'generateReport'])->name('generateReport');

    // ==== ROUTE Admin ====
    Route::middleware(['auth','AdminAccess'])->group(function(){
        Route::get('paket', [PaketController::class, 'index']);
        Route::get('paket/add', [PaketController::class, 'add']);
        Route::get('paket/edit/{id}', [PaketController::class, 'edit']);
        Route::post('paket/store', [PaketController::class, 'store']);
        Route::get('paket/delete/{id}', [PaketController::class, 'delete']);
        Route::post('paket/update', [PaketController::class, 'update']);

        Route::get('outlet', [OutletController::class, 'index']);
        Route::get('outlet/add', [OutletController::class, 'add']);
        Route::get('outlet/edit/{id}', [OutletController::class, 'edit']);
        Route::post('outlet/store', [OutletController::class, 'store']);
        Route::get('outlet/delete/{id}', [OutletController::class, 'delete']);
        Route::post('outlet/update', [OutletController::class, 'update']);

        Route::get('user', [UsersController::class, 'index']);
        Route::get('user/add', [UsersController::class, 'add']);
        Route::get('user/edit/{id}', [UsersController::class, 'edit']);
        Route::post('user/store', [UsersController::class, 'store']);
        Route::get('user/delete/{id}', [UsersController::class, 'delete']);
        Route::post('user/update', [UsersController::class, 'update']);

    });
    // ==== ROUTE Kasir ====
    Route::middleware(['auth','KasirAccess'])->group(function(){

        Route::get('customer', [CustomerController::class, 'index']);
        Route::get('customer/add', [CustomerController::class, 'add']);
        Route::get('customer/edit/{id}', [CustomerController::class, 'edit']);
        Route::post('customer/store', [CustomerController::class, 'store']);
        Route::get('customer/delete/{id}', [CustomerController::class, 'delete']);
        Route::post('customer/update', [CustomerController::class, 'update']);

        Route::get('transaksi/add', [TransaksiController::class, 'add']);
        Route::get('transaksi/{id_outlet?}', [TransaksiController::class, 'index']);
        Route::get('transaksi/edit/{id}', [TransaksiController::class, 'edit']);
        Route::post('transaksi/store', [TransaksiController::class, 'store']);
        Route::get('transaksi/delete/{id}', [TransaksiController::class, 'delete']);
        Route::post('transaksi/update', [TransaksiController::class, 'update']);

        Route::get('transaksi/detail/{id}', [DetailTransaksiController::class, 'index']);
        Route::post('detail-transaksi/store/{id}', [DetailTransaksiController::class, 'store']);


});

});
