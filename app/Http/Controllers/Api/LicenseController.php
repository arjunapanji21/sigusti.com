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
        $license = License::where('license_key', $request->license_key)->first();

        if (!$license) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid license key'
            ], 404);
        }

        $license->last_check = now();
        $license->save();

        return response()->json([
            'status' => 'success',
            'data' => [
                'is_valid' => $license->isValid(),
                'expires_at' => $license->expires_at,
                'daily_limit' => $license->daily_limit,
                'monthly_limit' => $license->monthly_limit,
                'daily_usage' => $license->daily_usage,
                'monthly_usage' => $license->monthly_usage
            ]
        ]);
    }

    public function updateUsage(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
            'daily_usage' => 'required|integer',
            'monthly_usage' => 'required|integer'
        ]);

        $license = License::where('license_key', $request->license_key)->first();

        if (!$license) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid license key'
            ], 404);
        }

        $license->update([
            'daily_usage' => $request->daily_usage,
            'monthly_usage' => $request->monthly_usage
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Usage updated successfully'
        ]);
    }
}
