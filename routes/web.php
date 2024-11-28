<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuPublicController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DataRestoranController;

use App\Http\Middleware;
// Halaman utama
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('cart', CartController::class)->middleware('auth');

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{menuId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('dinein/{menuId}', [OrderController::class, 'dineIn'])->name('order.dinein');
    Route::post('takeaway/{menuId}', [OrderController::class, 'takeAway'])->name('order.takeaway');
    Route::post('submit/{menuId}', [OrderController::class, 'submit'])->name('order.submit');
    Route::get('checkout/{menuId}/{type}', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('finalize', [OrderController::class, 'finalize'])->name('order.finalize');
    Route::get('choose/{menuId}', [OrderController::class, 'choose'])->name('order.choose');
    Route::get('success/{orderId}', [OrderController::class, 'success'])->name('order.success');

    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('{id}', [OrderController::class, 'update'])->name('orders.update');

// Rute untuk menu publik yang bisa diakses oleh user dan admin
Route::get('/daftar-menu', [MenuPublicController::class, 'index'])->name('daftar-menu');
Route::get('/data-restoran', [DataRestoranController::class, 'index'])->name('datarestoran.index');
Route::put('/data-restoran', [DataRestoranController::class, 'index']);

// Resource routes untuk kategori dan menu yang hanya bisa diakses oleh admin
Route::resource('kategoris', KategoriController::class);
Route::resource('menus', MenuController::class);
});

// Route::middleware('auth')->group(function () {
//     // Rute untuk menambah item ke keranjang
//     Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

//     // Rute untuk melihat keranjang
//     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

//     // Rute untuk menghapus item dari keranjang
//     Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// });
