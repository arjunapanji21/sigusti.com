<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('landing');

// Authentication routes (provided by Laravel's built-in authentication)
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Profile routes
    Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile.index');
    
    // Settings routes
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');
    
    // Documentation
    Route::get('/docs', function () {
        return view('docs.index');
    })->name('documentation');

    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });
});

// Add fallback route for 404 errors
Route::fallback(function () {
    return response()->view('pages.errors.404', [], 404);
});
