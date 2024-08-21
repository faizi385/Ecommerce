<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WishlistController;
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
// Route for displaying the homepage
Route::get('/', [SectionController::class, 'show'])->name('welcome');
// Route for dashboard (admin panel)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Cart routes
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/contents', [CartController::class, 'getCartContents'])->name('cart.contents');
    Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/apply-discount', [CartController::class, 'applyDiscount'])->name('cart.applyDiscount');
    Route::post('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    // Wishlist routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{productId}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{productId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    // Order routes
    Route::resource('orders', OrderController::class)->except(['destroy']);
    Route::post('orders/{order}/approve', [OrderController::class, 'approve'])->name('admin.orders.approve');
    // Product routes
    Route::resource('products', ProductController::class);
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
});
// Admin-specific routes
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('admin/sections/edit', [SectionController::class, 'edit'])->name('admin.sections.edit');
    Route::post('admin/sections/update', [SectionController::class, 'update'])->name('admin.sections.update');
});
// Static pages
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('checkout', function () {
    return view('cart.checkout');
})->name('checkout');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');
// Test email route
Route::get('/test-email', [TestEmailController::class, 'sendTestEmail']);
require __DIR__.'/auth.php';














