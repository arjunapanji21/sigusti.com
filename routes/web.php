<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SubscriptionController;

// Public routes
Route::get('/', function () {
    return view('pages.landing');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Common routes for both admin and users
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // User management
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    
    // Activity logs
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
    
    // Subscription and payment routes
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('/subscription/payments/{payment}', [SubscriptionController::class, 'show'])->name('subscription.show');
    
    // User-only routes
    Route::middleware(['can:user-actions'])->group(function () {
        Route::post('/subscription/{plan}/purchase', [SubscriptionController::class, 'purchase'])
            ->name('subscription.purchase');
        Route::post('/subscription/confirm-payment', [SubscriptionController::class, 'confirmPayment'])
            ->name('subscription.confirm-payment');
    });
    
    // Admin-only routes
    Route::middleware(['can:admin-actions'])->group(function () {
        Route::post('/subscription/payments/{payment}/verify', [SubscriptionController::class, 'verifyPayment'])
            ->name('subscription.verify-payment');
    });

    // Documentation and Support routes
    Route::get('/documentation', function () {
        return view('pages/documentation');
    })->name('documentation');

    Route::get('/support', function () {
        return view('pages/support');
    })->name('support');

    Route::get('/download', function () {
        return view('pages/download');
    })->name('download');
});

// Error pages
Route::fallback(function () {
    return view('pages.errors.404');
});
