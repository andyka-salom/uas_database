<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KartuStokController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\MarginPenjualanController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login.index');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');










Route::get('/dashboard', [DashboardController::class, 'index']);



    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/generate-daily-sales-report', [AdminController::class, 'generateDailySalesReport']);

    Route::post('/get-procurement-summary', [AdminController::class, 'getProcurementSummary']);
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
    
    Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan.index');
    Route::get('/satuan/{id}/edit', [SatuanController::class, 'edit'])->name('satuan.edit');
    Route::put('/satuan/{id}', [SatuanController::class, 'update'])->name('satuan.update');
    Route::post('/satuan', [SatuanController::class, 'store'])->name('satuan.store');
    Route::delete('/satuan/{id}', [SatuanController::class, 'destroy'])->name('satuan.destroy');
    Route::post('/satuan/{id}/activate', [SatuanController::class, 'activate'])->name('satuan.activate');
    
    Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
    Route::get('/vendors/{id}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
    Route::put('/vendors/{id}', [VendorController::class, 'update'])->name('vendors.update');
    Route::post('/vendors', [VendorController::class, 'store'])->name('vendors.store');
    Route::delete('/vendors/{id}', [VendorController::class, 'destroy'])->name('vendors.destroy');
    Route::post('/vendors/{id}/activate', [VendorController::class, 'activate'])->name('vendors.activate');
    Route::resource('roles', RoleController::class);
    
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles/{id}/activate', [RoleController::class, 'activate'])->name('roles.activate');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
    Route::post('/items/{id}/activate', [ItemController::class, 'activate'])->name('items.activate');
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

    Route::get('/penerimaan', [PenerimaanController::class, 'index'])->name('penerimaan.index');
    Route::post('/tambah-penerimaan', [PenerimaanController::class, 'tambahPenerimaan'])->name('tambahPenerimaan');

    Route::get('/receipt', [ReceiptController::class, 'index'])->name('receipt.index');
    Route::get('/receipt/create', [ReceiptController::class, 'create'])->name('receipt.create');
    Route::post('/receipt/store', [ReceiptController::class, 'store'])->name('receipt.store');

    Route::get('/retur', [ReturnController::class, 'index'])->name('retur');
    Route::post('/add-return', [ReturnController::class, 'addReturn'])->name('addReturn');
    Route::view('/returns', 'admin.retur')->name('returns');
    Route::get('/api/returns', [ReturController::class, 'index']);
    Route::get('/api/returns/{id}', [ReturController::class, 'show']);

        Route::view('/returns', 'admin.retur')->name('returns');
            Route::get('/api/returns', [ReturController::class, 'index']);
            Route::get('/api/returns/{id}', [ReturController::class, 'show']);

    Route::get('/calculateTotalSales/{salesID}', [DashboardController::class, 'calculateTotalSales'])->name('calculateTotalSales');
    Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.index');
    Route::get('/api/calculateTotalPengadaan', [PengadaanController::class, 'calculateTotalPengadaan']);
    Route::post('/api/createPengadaan', [PengadaanController::class, 'createPengadaan']);
    
    
    Route::get('/margin_penjualan', [MarginPenjualanController::class, 'index'])->name('margin_penjualan.index');
    Route::post('/margin_penjualan', [MarginPenjualanController::class, 'store'])->name('margin_penjualan.store');
    Route::put('/margin_penjualan/{id}', [MarginPenjualanController::class, 'update'])->name('margin_penjualan.update');
    Route::post('/margin_penjualan/activate/{id}', [MarginPenjualanController::class, 'activate'])->name('margin_penjualan.activate');
    Route::delete('/margin_penjualan/{id}', [MarginPenjualanController::class, 'destroy'])->name('margin_penjualan.destroy');
    
    Route::get('/receipt', [ReceiptController::class, 'index'])->name('receipt.index');
    Route::get('/receipt/create', [ReceiptController::class, 'create'])->name('receipt.create');
    Route::post('/receipt/store', [ReceiptController::class, 'store'])->name('receipt.store');


    Route::get('/kartustok', [KartuStokController::class, 'index'])->name('kartustok.index');




    Route::get('/retur', [ReturnController::class, 'index'])->name('retur');
    Route::post('/add-return', [ReturnController::class, 'addReturn'])->name('addReturn');
  

    Route::post('/tambah-penjualan', [PenjualanController::class, 'tambahPenjualan'])->name('penjualan.index');
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::post('/tambah-penjualan', [PemesananController::class, 'tambahPenjualan'])->name('tambah_penjualan');

    Route::get('/kartustok', [KartuStokController::class, 'index'])->name('kartustok.index');

