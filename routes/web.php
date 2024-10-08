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
Route::get('/', [Transaksi::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/detail/{id}', [Transaksi::class, 'detail'])->name('transaksi.detail');
Route::get('/transaksi/create', [Transaksi::class, 'create'])->name('transaksi.create');
Route::post('/transaksi/store', [Transaksi::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/edit/{id}', [Transaksi::class, 'edit'])->name('transaksi.edit');
Route::post('/transaksi/edit/{id}', [Transaksi::class, 'update'])->name('transaksi.update');
Route::get('/transaksi/{id}', [Transaksi::class, 'delete'])->name('transaksi.delete');
