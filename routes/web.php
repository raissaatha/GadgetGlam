<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HistoryController;

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

// Home
Route::get('/', [CartController::class, 'index']);

// Register
Route::get('/register', [AuthController::class, 'rindex']);
Route::post('/register', [AuthController::class, 'rstore']);

// Login
Route::get('/login', [AuthController::class, 'lindex'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class,'logout']);

// route admin
Route::group(['middleware' => ['auth','CekLevel:admin']], function() {
    // produk
    Route::resource('/product', ProductController::class);

    // Transaksi
    Route::get('/transaksi',  [TransactionController::class, 'transaksi']);
    // Detail Pesanan
    Route::get('/cart', [CartController::class, 'cart']);
    // verifikasi pembayaran
    Route::get('/verify', [TransactionController::class, 'verify']);
    Route::get('/block', [TransactionController::class, 'block']);

});

// route user-admin
Route::group(['middleware' => ['auth','CekLevel:admin,user']], function() {

    // Detail Cart
    Route::get('/detail/{id}', [CartController::class, 'dcart']);

    // Pesanan
    Route::get('/pesan/{id}', [TransactionController::class, 'pesan']);
    Route::post('/pesan/{id}', [TransactionController::class, 'pesan']);
    Route::get('/check-out', [TransactionController::class, 'check_out']);
    Route::get('/konfirmasi', [TransactionController::class, 'konfirmasi']);
    Route::get('/check-out/{id}/delete', [TransactionController::class, 'delete']);


    Route::get('profile', [TransactionController::class, 'pindex']);
    Route::post('profile', [TransactionController::class, 'update']);


    Route::get('history',  [HistoryController::class, 'index']);
    Route::get('history/{id}',  [HistoryController::class, 'detail']);
    Route::post('uploadbukti/{id}', [HistoryController::class, 'store'])->name('upload.bukti');
});

// Route DataUser
Route::get('/datauser',  [DataUserController::class, 'index']);

