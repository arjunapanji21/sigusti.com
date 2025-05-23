<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LicenseController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string'
        ]);

        $license = License::where('license_key', $request->license_key)
            ->where('is_active', true)
            ->first();

        if (!$license) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or inactive license key'
            ], 404);
        }

        if ($license->expires_at->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => 'License has expired'
            ], 403);
        }

        // Hitung jumlah IP Address yang berbeda pada aktivitas license dalam 24 jam terakhir
        $ipCount = $license->activities()
            ->where('created_at', '>=', now()->subDay())
            ->distinct('ip_address')
            ->count('ip_address');
        
        // jika jumlah IP Address lebih dari jumlah license->max_devices, maka license dianggap tidak valid
        if ($ipCount > $license->max_device) {
            return response()->json([
                'status' => 'error',
                'message' => 'Maximum device limit exceeded, please upgrade your license.'
            ], 403);
        }

        // Update last check and create activity log
        $license->update(['last_check' => now()]);
        $license->activities()->create([
            'activity_type' => 'license_check',
            'details' => 'License verified from ' . $request->ip()
        ]);

        // Reset daily usage if it's a new day
        if ($license->last_check && $license->last_check->diffInDays(now()) >= 1) {
            $license->update(['daily_usage' => 0]);
        }

        // Reset monthly usage if it's a new month
        if ($license->last_check && $license->last_check->diffInMonths(now()) >= 1) {
            $license->update(['monthly_usage' => 0]);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'is_valid' => true,
                'expires_at' => $license->expires_at,
                'daily_limit' => $license->daily_limit,
                'monthly_limit' => $license->monthly_limit,
                'daily_usage' => $license->daily_usage,
                'monthly_usage' => $license->monthly_usage,
                'remaining_days' => now()->diffInDays($license->expires_at)
            ]
        ]);
    }

    public function updateUsage(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
            'daily_usage' => 'required|integer|min:0',
            'monthly_usage' => 'required|integer|min:0'
        ]);

        $license = License::where('license_key', $request->license_key)
            ->where('is_active', true)
            ->first();

        if (!$license) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or inactive license key'
            ], 404);
        }

        // Check usage limits
        if ($request->daily_usage > $license->daily_limit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Daily usage limit exceeded'
            ], 403);
        }

        if ($request->monthly_usage > $license->monthly_limit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Monthly usage limit exceeded'
            ], 403);
        }

        $license->update([
            'daily_usage' => $request->daily_usage,
            'monthly_usage' => $request->monthly_usage,
            'last_check' => now()
        ]);

        $license->activities()->create([
            'activity_type' => 'usage_update',
            'details' => "Usage updated - Daily: {$request->daily_usage}, Monthly: {$request->monthly_usage}"
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Usage updated successfully',
            'data' => [
                'daily_remaining' => $license->daily_limit - $request->daily_usage,
                'monthly_remaining' => $license->monthly_limit - $request->monthly_usage
            ]
        ]);
    }
}
