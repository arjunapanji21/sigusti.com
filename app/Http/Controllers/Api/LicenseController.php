<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LicenseController extends Controller
{
    public function test(){
        return response()->json([
            'status' => 'success',
            'message' => 'License API is working'
        ]);
    }
    
    public function verify(Request $request)
    {
        try {
            $request->validate([
                'license_key' => 'required|string',
                'mac_address' => 'required|string'
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
    
            // Check unique MAC addresses in last 2 hours instead of IP addresses
            $deviceCount = $license->activities()
                ->where('activity_type', 'license_check')
                ->where('mac_address', $request->mac_address)
                ->where('created_at', '>=', now()->subHours(2))
                ->distinct('mac_address')
                ->count();
            
            if ($deviceCount > $license->max_device) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Maximum device limit exceeded, please upgrade your license.'
                ], 403);
            }
    
            // Update last check and create activity log with MAC address
            $license->update(['last_check' => now()]);
            $license->activities()->create([
                'activity_type' => 'license_check',
                'details' => 'License verified from ' . $request->ip() . ' (' . $request->mac_address . ')',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'mac_address' => $request->mac_address
            ]);
    
            // Reset daily usage if it's a new day
            if ($license->last_check && $license->last_check->diffInDays(now()) >= 1) {
                $license->update(['daily_usage' => 0]);
            }
    
            // Reset monthly usage if it's a new month
            if ($license->last_check && $license->last_check->diffInMonths(now()) >= 1) {
                $license->update(['monthly_usage' => 0]);
            }
    
            // Check usage limits
            if ($license->daily_usage > $license->daily_limit) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Daily usage limit exceeded',
                    'data' => [
                        'daily_remaining' => $license->daily_limit - $license->daily_usage,
                        'monthly_remaining' => $license->monthly_limit - $license->monthly_usage
                    ]
                ], 403);
            }
    
            if ($license->monthly_usage > $license->monthly_limit) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Monthly usage limit exceeded',
                    'data' => [
                        'daily_remaining' => $license->daily_limit - $license->daily_usage,
                        'monthly_remaining' => $license->monthly_limit - $license->monthly_usage
                    ]
                ], 403);
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
                    'remaining_days' => Carbon::parse($license->expires_at)->diffInDays(now())
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while verifying the license: ' . $th->getMessage()
            ], 500);
        }
    }

    public function updateUsage(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
            'daily_usage' => 'required|integer|min:0',
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

        // Reset daily usage if it's a new day
        if ($license->last_check && $license->last_check->diffInDays(now()) >= 1) {
            $license->daily_usage = 0;
        }

        // Reset monthly usage if it's a new month
        if ($license->last_check && $license->last_check->diffInMonths(now()) >= 1) {
            $license->monthly_usage = 0;
        }

        // Calculate new usage values
        $newDailyUsage = $license->daily_usage + $request->daily_usage;
        $newMonthlyUsage = $license->monthly_usage + $request->daily_usage;

        // Check if new usage would exceed limits
        if ($newDailyUsage >= $license->daily_limit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Daily usage limit would be exceeded',
                'data' => [
                    'daily_remaining' => max(0, $license->daily_limit - $license->daily_usage),
                    'monthly_remaining' => max(0, $license->monthly_limit - $license->monthly_usage)
                ]
            ], 403);
        }

        if ($newMonthlyUsage >= $license->monthly_limit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Monthly usage limit would be exceeded',
                'data' => [
                    'daily_remaining' => max(0, $license->daily_limit - $license->daily_usage),
                    'monthly_remaining' => max(0, $license->monthly_limit - $license->monthly_usage)
                ]
            ], 403);
        }

        // Apply the new usage values
        $license->update([
            'daily_usage' => $newDailyUsage,
            'monthly_usage' => $newMonthlyUsage,
            'last_check' => now()
        ]);

        $license->activities()->create([
            'activity_type' => 'usage_update',
            'details' => "Usage updated - sent {$request->daily_usage} messages.",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Usage updated successfully',
            'data' => [
                'daily_remaining' => $license->daily_limit - $license->daily_usage,
                'monthly_remaining' => $license->monthly_limit - $license->monthly_usage
            ]
        ]);
    }
}
