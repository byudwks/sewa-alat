<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrasiController;
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

// about
Route::get('/home', function() {
    return view('home', [
        'title' => 'Home',
        'active' => 'home'
    ]);
});

// postingan
Route::get('/post', [PostController::class, 'index']);
Route::get('post/{post:id}', [PostController::class, 'show']);

// login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);

//registrasi
Route::get('/registrasi', [RegistrasiController::class, 'index'])->middleware('guest');
Route::post('/registrasi', [RegistrasiController::class, 'regis']);

//logout
Route::post("/logout", [LoginController::class, 'logout']);

//pesanan
Route::get('/cekout', [PesananController::class, 'cekout'])->middleware(['auth' , 'client']);
Route::post('post/{post:id}',[PesananController::class, 'pesanan'])->middleware(['auth' , 'client']);
Route::get('cekout/edit/{pesan:id}' , [PesananController::class, 'storepesan'])->middleware(['auth' , 'client']);
Route::put('cekout/update/{pesan:id}' , [PesananController::class, 'storeupdate'])->middleware(['auth' , 'client']);
Route::get('cekout/batalkan/{pesan:id}', [PesananController::class, 'batalpesan'])->middleware(['auth', 'client']);
Route::match (['get', 'post'], 'cekout/kondisi/{pesan:id}', [PesananController::class, 'kondisi'])->middleware(['auth', 'client']);


//admin
Route::resource('/admin', DashboardController::class)->middleware(['auth', 'admin']);
Route::get('/orders', [OrdersController::class, 'orders'])->middleware(['auth', 'admin']);
Route::get('orders/{pesan:id}', [OrdersController::class, 'viewOrder'])->middleware(['auth', 'admin']);
Route::post('orders-pesanselesai/{pesan:id}', [OrdersController::class, 'pesananSelesai'])->middleware(['auth', 'admin']);
Route::put('orders/{pesan:id}', [OrdersController::class, 'update'])->middleware(['auth', 'admin']);
Route::post('orders/{pesan:id}', [OrdersController::class, 'returndate'])->middleware(['auth', 'admin']);


//invoice
Route::get('invoice/{pesan:id}', [InvoiceController::class, 'printPdf']);
Route::get('invoice/dwonloadPdf/{pesan:id}', [InvoiceController::class, 'dwonloadPdf']);

Route::get('/buat_laporan', [InvoiceController::class, 'laporan']);
