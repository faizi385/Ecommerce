<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TestEmailController;

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

Route::resource('orders', OrderController::class);
Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');


Route::resource('users', UserController::class);
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

// Route to handle the profile update form submission
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::post('checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/search', [ProductController::class, 'index'])->name('search');

    // Order routes
    Route::resource('orders', OrderController::class)->only(['index', 'store', 'update', 'create']);
    // Ensure you have create method in OrderController
    Route::post('order/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
// routes/web.php
// routes/web.php
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/test-email', [TestEmailController::class, 'sendTestEmail']);
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');


    // In web.php
Route::middleware('role:Admin')->group(function () {
    Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::post('admin/orders/{order}/approve', [OrderController::class, 'approve'])->name('admin.orders.approve');
    
});
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});
});

Route::resource('products', ProductController::class);
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('checkout', function () {
    return view('cart.checkout');
})->name('checkout');

require __DIR__.'/auth.php';
