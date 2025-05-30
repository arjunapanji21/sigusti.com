<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LegalController;

// Public routes
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Add legal routes
Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Ensure consistent naming
    Route::get('signin', [AuthenticatedSessionController::class, 'create'])
        ->name('signin');
    Route::post('signin', [AuthenticatedSessionController::class, 'store']);
    
    Route::get('signup', [RegisteredUserController::class, 'create'])
        ->name('signup');
    Route::post('signup', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Email Verification Routes  
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('/email/verify/{token}', [VerificationController::class, 'verify'])
        ->name('verification.verify');

    Route::post('/email/resend', [VerificationController::class, 'resend'])
        ->name('verification.resend');
});

// Protected routes that require email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('change-password');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change-password.update');
        Route::get('/delete', [ProfileController::class, 'showDeleteAccountForm'])->name('delete');
        Route::delete('/delete', [ProfileController::class, 'deleteAccount'])->name('delete.confirm');
    });

    // User management
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/export', [UsersController::class, 'export'])->name('users.export');
    Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    
    // License and Payment routes
    Route::prefix('licenses')->name('licenses.')->group(function () {
        Route::get('/', [LicenseController::class, 'index'])->name('index');
        Route::get('/{license}', [LicenseController::class, 'show'])->name('show');
        Route::middleware(['can:admin-actions'])->group(function () {
            Route::put('/{license}/activate', [LicenseController::class, 'activate'])->name('activate');
            Route::put('/{license}/deactivate', [LicenseController::class, 'deactivate'])->name('deactivate');
        });
    });

    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/create', [PaymentController::class, 'create'])->name('create');
        Route::post('/initiate', [PaymentController::class, 'initiate'])->name('initiate');
        Route::get('/{payment}/upload', [PaymentController::class, 'showUpload'])->name('upload');
        Route::post('/{payment}/upload', [PaymentController::class, 'uploadProof'])->name('upload.store');
        Route::get('/{payment}', [PaymentController::class, 'show'])->name('show');
        Route::get('/{payment}/invoice', [PaymentController::class, 'downloadInvoice'])->name('invoice.download');
        
        // Admin routes
        Route::middleware(['can:admin-actions'])->group(function () {
            Route::put('/{payment}/approve', [PaymentController::class, 'approve'])->name('approve');
            Route::put('/{payment}/reject', [PaymentController::class, 'reject'])->name('reject');
        });
    });

    // Admin-only routes
    Route::middleware(['can:admin-actions'])->group(function () {
        
        // Add Plans Resource Routes
        Route::resource('plans', PlanController::class);
    });

    // Documentation and Support routes
    Route::get('/documentation', function () {
        return view('pages/documentation');
    })->name('documentation');

    Route::get('/support', [SupportController::class, 'index'])->name('support');
    Route::post('/support', [SupportController::class, 'store'])->name('support.store');

    // Download routes
    Route::prefix('download')->name('download.')->middleware(['auth'])->group(function () {
        Route::get('/', [DownloadController::class, 'index'])->name('index');
        Route::get('/file', [DownloadController::class, 'download'])->name('file');
    });
});

// Add fallback route for 404 errors
Route::fallback(function () {
    return response()->view('pages.errors.404', [], 404);
});
