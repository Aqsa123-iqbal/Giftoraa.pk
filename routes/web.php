<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuizController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// 🔐 Authentication Routes
Auth::routes(['reset' => false, 'verify' => false, 'confirm' => false]);

// 🌐 Home Page & Category Filter
Route::get('/', [ProductController::class, 'index'])->name('welcome');
Route::get('/home', [ProductController::class, 'index'])->name('home');

// 👑 Admin Panel & Secured Routes
Route::group(['middleware' => ['auth', function ($request, $next) {
    if (Auth::user() && Auth::user()->is_admin == 1) {
        return $next($request);
    }
    return redirect('/home')->with('error', 'Access Denied: You are not an admin.');
}]], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}/update', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}/delete', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});

// 🛠️ Admin Setup Route
Route::get('/create-admin', function () {
    User::updateOrCreate(
        ['email' => 'admin@gmail.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('admin123pass456'),
            'is_admin' => 1
        ]
    );
    return "Admin user successfully created/updated!";
});

// 🛒 Cart Action Routes (Yahan route sahi hain)
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'cartIndex'])->name('cart.index');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::patch('/cart/update/{id}', [CartController::class, 'updateCartQuantity'])->name('cart.update');

// 💖 Wishlist Action Routes (Yahan route sahi hain)
Route::post('/wishlist/add/{id}', [CartController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist', [CartController::class, 'wishlistIndex'])->name('wishlist.index');
Route::delete('/wishlist/remove/{id}', [CartController::class, 'removeFromWishlist'])->name('wishlist.remove');

// 💳 Checkout & Order Process
Route::get('/checkout', [CartController::class, 'checkoutIndex'])->name('checkout.index');
Route::post('/order/place', [CartController::class, 'placeOrder'])->name('order.place');
Route::get('/order/cancel', [CartController::class, 'cancelOrder'])->name('order.cancel');

// 🎯 Product Details
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// 🎁 AI Gift Finder Routes
Route::get('/gift-finder', [QuizController::class, 'index'])->name('quiz.index');
Route::post('/gift-finder/results', [QuizController::class, 'getRecommendations'])->name('quiz.results');