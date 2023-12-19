<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\VendorController;


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

Route::get('/', function () {
    return view('welcome');
});


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

use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::post('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


use App\Http\Controllers\ItemController;

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
Route::post('/items/{id}/activate', [ItemController::class, 'activate'])->name('items.activate');
Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

// routes/web.php

use App\Http\Controllers\PengadaanController;

Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.index');
Route::get('/api/calculateTotalPengadaan', [PengadaanController::class, 'calculateTotalPengadaan']);
Route::post('/api/createPengadaan', [PengadaanController::class, 'createPengadaan']);

use App\Http\Controllers\MarginPenjualanController;

Route::get('/margin_penjualan', [MarginPenjualanController::class, 'index'])->name('margin_penjualan.index');
Route::post('/margin_penjualan', [MarginPenjualanController::class, 'store'])->name('margin_penjualan.store');
Route::put('/margin_penjualan/{id}', [MarginPenjualanController::class, 'update'])->name('margin_penjualan.update');
Route::post('/margin_penjualan/activate/{id}', [MarginPenjualanController::class, 'activate'])->name('margin_penjualan.activate');
Route::delete('/margin_penjualan/{id}', [MarginPenjualanController::class, 'destroy'])->name('margin_penjualan.destroy');
