<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\NotificationController;
use App\Models\Product;
use App\Models\User;
use App\Models\Booking;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\BrowseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
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
Route::middleware(['auth', 'verified'])->post('/products/{product}/bookings', [BookingController::class, 'store'])->name('products.bookings.store');
Route::middleware(['auth', 'verified'])->get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::middleware(['auth', 'verified'])->get('/bookings/requests', [BookingController::class, 'ownerRequests'])->name('bookings.requests');
Route::middleware(['auth', 'verified'])->post('/bookings/{booking}/accept', [BookingController::class, 'accept'])->name('bookings.accept');
Route::middleware(['auth', 'verified'])->post('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
Route::middleware(['auth', 'verified'])->post('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');
Route::middleware(['auth', 'verified'])->get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rental routes
Route::middleware(['auth'])->group(function () {
    Route::get('/my-rentals', [ListingController::class, 'myRentals'])->name('listings.my-rentals');
    Route::get('/rented-out', [ListingController::class, 'rentedOut'])->name('listings.rented-out');
    Route::get('/all-rentals', [ListingController::class, 'allRentals'])->name('listings.all-rentals')->middleware('can:viewAny,App\Models\Booking');
});

// Rental history routes
Route::middleware(['auth'])->group(function () {
    Route::get('/my-rentals', [BookingController::class, 'myRentals'])->name('rentals.my');
    Route::get('/rented-out', [BookingController::class, 'rentedOut'])->name('rentals.out');

    Route::middleware(['admin'])->group(function () {
        Route::get('/all-rentals', [BookingController::class, 'allRentals'])->name('rentals.all');
    });
});

// Borrowed products history
Route::get('/discovered/history', [BrowseController::class, 'history'])->name('discovered.history')->middleware('auth');

require __DIR__ . '/auth.php';

// Product routes
Route::resource('products', ProductController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

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
Route::middleware(['auth', 'verified'])->post('/products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
Route::middleware(['auth', 'verified'])->post('/products/{product}/mark-rented', [ProductController::class, 'markRented'])->name('products.mark-rented');
