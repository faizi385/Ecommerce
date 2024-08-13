<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart routes
// Cart routes
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/contents', [CartController::class, 'getCartContents'])->name('cart.contents');

Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/search', [ProductController::class, 'index'])->name('search');

    // Order routes
    Route::resource('orders', OrderController::class)->only(['index', 'store', 'update', 'create']);
    // Ensure you have create method in OrderController
    Route::post('order/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show');

    // In web.php
Route::middleware('role:Admin')->group(function () {
    Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::post('admin/orders/{order}/approve', [OrderController::class, 'approve'])->name('admin.orders.approve');
    
});
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});
});

Route::resource('products', ProductController::class);
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('checkout', function () {
    return view('cart.checkout');
})->name('checkout');

require __DIR__.'/auth.php';