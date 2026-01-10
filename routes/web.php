<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use App\Models\Booking;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $products = Product::where('status', 'active')->latest()->take(10)->get();
    $users = User::latest()->get();
    $totalUsers = User::count();
    $totalTransactions = Booking::count();
    return view('dashboard', compact('products', 'users', 'totalUsers', 'totalTransactions'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->get('/home', [UserController::class, 'home'])->name('home');
Route::middleware(['auth', 'verified'])->get('/my-listings', [UserController::class, 'myListings'])->name('users.my-listings');
Route::middleware(['auth', 'verified'])->get('/my-product-list', [UserController::class, 'myProductList'])->name('users.my-product-list');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Product routes
Route::resource('products', ProductController::class);

// Users routes
Route::resource('users', UserController::class)->only(['index', 'show', 'edit', 'update', 'create', 'store', 'destroy']);

// Admin routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::post('/users/{user}/disable', [AdminController::class, 'disable'])->name('users.disable');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
    Route::post('/products/{product}/flag', [AdminController::class, 'flag'])->name('products.flag');
    Route::delete('/products/{product}', [AdminController::class, 'destroy'])->name('products.destroy');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])
        ->name('users.edit');
});
