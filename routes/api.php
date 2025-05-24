<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LicenseController;

// License API endpoints
Route::get('/test', [LicenseController::class, 'test']);
Route::prefix('license')->group(function () {
    Route::post('/verify', [LicenseController::class, 'verify']);
    Route::post('/update-usage', [LicenseController::class, 'updateUsage']);
});
