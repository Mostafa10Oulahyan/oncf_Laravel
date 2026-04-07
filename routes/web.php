<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;

// Homepage - Search
Route::get('/', [VoyageController::class, 'index']);

// Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');

// Search results
Route::get('/voyages/search', [VoyageController::class, 'search']);

// Cart routes
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::patch('/cart/update', [CartController::class, 'update']);
Route::delete('/cart/remove', [CartController::class, 'remove']);
Route::get('/cart/clear', [CartController::class, 'clear']);

// Checkout routes (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [BookingController::class, 'checkout']);
    Route::post('/checkout', [BookingController::class, 'processCheckout']);
    
    // Payment routes
    Route::get('/payment', [BookingController::class, 'payment']);
    Route::post('/payment', [BookingController::class, 'processPayment']);
    
    // Confirmation
    Route::get('/confirmation', [BookingController::class, 'confirmation']);
    
    // My Tickets
    Route::get('/my-tickets', [BookingController::class, 'myTickets'])->name('my-tickets');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes - Protected by AdminMiddleware
// TEMPORARY: Middleware disabled until AdminMiddleware.php is created
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/voyages/create', [AdminController::class, 'createVoyage'])->name('admin.voyages.create');
    Route::post('/voyages', [AdminController::class, 'storeVoyage'])->name('admin.voyages.store');
    Route::get('/voyages/{id}/edit', [AdminController::class, 'editVoyage'])->name('admin.voyages.edit');
    Route::put('/voyages/{id}', [AdminController::class, 'updateVoyage'])->name('admin.voyages.update');
    Route::delete('/voyages/{id}', [AdminController::class, 'deleteVoyage'])->name('admin.voyages.delete');
});
