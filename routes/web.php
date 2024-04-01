<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Products
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
// Products

// Pos
Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
Route::get('/pos/cart', [PosController::class, 'cartItemList'])->name('pos.cartItemList');
Route::post('/pos/{productId}/add-to-cart', [PosController::class, 'addToCart'])->name('pos.addToCart');
Route::delete('/pos/{productId}/delete-cart-item', [PosController::class, 'deleteCartItem'])->name('pos.deleteCartItem');
Route::post('/pos/{productId}/update-cart-item', [PosController::class, 'updateCartItem'])->name('pos.updateCartItem');
Route::get('/pos/search',  [PosController::class, 'filter'])->name('pos.filter');
// Pos

// Order
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
// Order



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
