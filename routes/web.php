<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Resource routes
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ListingController;

Route::get('/', [BrowseController::class, 'index'])->name('browse');
Route::get('/my-rentals', [RentalController::class, 'index'])->name('my-rentals');
Route::get('/my-listings', [ListingController::class, 'index'])->name('my-listings');

// Resource routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::resource('bookings', BookingController::class);
Route::get('/bookings/{booking}/messages', [MessageController::class, 'show'])->name('messages.show');
Route::post('/bookings/{booking}/messages', [MessageController::class, 'store'])->name('messages.store');
Route::resource('messages', MessageController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('notifications', NotificationController::class);
Route::resource('users', UserController::class);

