<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\ChatController;

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Settings routes
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');
    
    // Documentation
    Route::get('/docs', function () {
        return view('docs.index');
    })->name('documentation');

    // Pemeriksaan routes
    Route::resource('pemeriksaan', PemeriksaanController::class)->except(['edit', 'update', 'destroy']);
    Route::get('/pemeriksaan/get/soal', [PemeriksaanController::class, 'getSoal'])->name('pemeriksaan.soal');
    Route::get('/pemeriksaan/{id}/print', [PemeriksaanController::class, 'print'])->name('pemeriksaan.print');

    // Balita routes
    Route::resource('balita', BalitaController::class);
    Route::get('/balita-search', [BalitaController::class, 'search'])->name('balita.search');

    // Materi routes
    Route::resource('materi', MateriController::class);

    // Admin routes
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });

    // Chat routes
    Route::middleware('auth')->group(function () {
        Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
        Route::get('/chat/create', function () {
            if (auth()->user()->is_admin) {
                abort(403, 'Admin cannot create new messages');
            }
            return view('chat.create');
        })->name('chat.create');
        Route::get('/chat/{user}', [App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
        Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'send'])->name('chat.send');
        Route::patch('/chat/{message}/read', [App\Http\Controllers\ChatController::class, 'markAsRead'])->name('chat.read');
    });
});

// Add fallback route for 404 errors
Route::fallback(function () {
    return response()->view('pages.errors.404', [], 404);
});
