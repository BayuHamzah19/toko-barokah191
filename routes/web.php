<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\Auth\FirebaseController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Services\FirestoreRest;
use Kreait\Firebase\Factory;


// Admin Routes
Route::middleware(['auth','is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/products', ProductController::class);
    Route::get('/admin/orders', [OrdersController::class, 'index'])->name('admin.orders');
    Route::get('admin/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('admin/products', [ProductController::class, 'store'])->name('products.store');
});

// User Routes
Route::middleware(['auth','is_user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
});


Route::middleware(['auth', 'is_user'])->group(function() {
    Route::get('/belanja', [BelanjaController::class, 'index'])->name('belanja.index');
});

// Public Routes
Route::view('/products', 'products')->name('products.index');
Route::view('/orders', 'orders')->name('orders.index');

// Form login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// POST login
//Route::post('/login', [AuthController::class, 'authlogin'])->name('login');

// Login Google
Route::post('/auth/google', [GoogleAuthController::class, 'authenticate'])
    ->middleware('api')
    ->name('google.authenticate');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'authRegister'])->name('register');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Firebase
Route::post('/auth/firebase', [FirebaseController::class, 'loginWithGoogle']);


// Guest Routes
Route::get('/', [GuestController::class, 'dashboard'])->name('guest.dashboard');
Route::get('/guest/product/{id}', [GuestController::class, 'productDetail'])->name('guest.product.detail');
Route::get('/guest/category/{id}', [GuestController::class, 'categoryProducts'])->name('guest.category');
Route::get('/guest/search', [GuestController::class, 'search'])->name('guest.search');

// Halaman detail produk
Route::get('/belanja/{product}', [BelanjaController::class, 'show'])->name('belanja.show');


Route::post('/belanja/{id}/beli', [BelanjaController::class, 'beli'])->name('belanja.beli');


Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::post('/orders/create/{productId}', [OrdersController::class, 'create'])->name('orders.create');
    Route::get('/orders/{order}/checkout', [OrdersController::class, 'checkout'])->name('orders.checkout');
});

// routes/web.php
Route::middleware(['auth'])->group(function() {
    Route::get('/checkout', [OrdersController::class, 'checkout'])->name('checkout.index');
});


Route::post('belanja/add-to-cart', [BelanjaController::class, 'addToCart'])->name('belanja.addToCart');

Route::prefix('react')->group(function () {
    Route::get('{any}', function () {
        return view('app-inertia');
    })->where('any', '.*');
});


//USER PROFIL 
// Halaman Profil User
Route::get('/user/profile', function () {
    return view('user.profile');
})->name('user.profile')->middleware(['auth']);

//edit

// Halaman edit profil user
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/user/profile/edit', [UserController::class, 'update'])->name('profile.update');


// Halaman Keranjang
Route::middleware(['auth'])->group(function () {

    Route::get('keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah/{id}', [CartController::class, 'store'])->name('cart.add');

    Route::put('/keranjang/update/{id}', [CartController::class, 'update'])->name('cart.update');

    Route::delete('/keranjang/hapus/{id}', [CartController::class, 'destroy'])->name('cart.delete');

});

//checkout select
Route::post('/checkout/selected', [CheckoutController::class, 'checkoutSelected'])
    ->name('checkout.selected');

Route::get('/checkout/single/{id}', [CheckoutController::class, 'checkoutSingle'])
     ->name('checkout.single');


Route::get('/checkout/single/{id}', [CheckoutController::class, 'checkoutSingle'])
    ->name('checkout.single');


