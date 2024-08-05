<?php

use App\Http\Controllers\Barang;
use App\Http\Controllers\Customer;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Transaksi;
use Illuminate\Support\Facades\Route;

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
// Dashboard
Route::get('/',[Dashboard::class,'index'])->name('dashboard');
// Customer
Route::get('/customer', [Customer::class, 'index'])->name('customer.index');
Route::post('/customer', [Customer::class, 'create'])->name('customer.create');
Route::post('/customer/{id}', [Customer::class, 'edit'])->name('customer.edit');
Route::get('/customer/{id}', [Customer::class, 'delete'])->name('customer.delete');
// Barang
Route::get('/barang', [Barang::class, 'index'])->name('barang.index');
Route::post('/barang', [Barang::class, 'create'])->name('barang.create');
Route::post('/barang/{id}', [Barang::class, 'edit'])->name('barang.edit');
Route::get('/barang/{id}', [Barang::class, 'delete'])->name('barang.delete');
// Transaksi
Route::get('/transaksi', [Transaksi::class, 'index'])->name('transaksi');
