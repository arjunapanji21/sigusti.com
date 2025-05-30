<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use App\Models\User;
use App\Models\Payment;
use App\Models\SystemEvent;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            // Basic Stats
            $totalUsers = User::where('is_admin', false)->count();
            $totalLicenses = License::count();
            $activeLicenses = License::where('is_active', true)->count();
            $monthlyRevenue = Payment::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->where('status', Payment::STATUS_APPROVED)
                ->sum('amount');
            $yearlyRevenue = Payment::whereYear('created_at', now()->year)
                ->where('status', Payment::STATUS_APPROVED)
                ->sum('amount');

            // Recent Users
            $recentUsers = User::where('is_admin', false)
                ->latest()
                ->take(5)
                ->get();

            // Expiring Licenses
            $expiringLicenses = License::where('expires_at', '>', now())
                ->where('expires_at', '<', now()->addDays(30))
                ->with('user')
                ->take(5)
                ->get();

            // System Health
            $serverLoad = $this->getServerLoad();
            $apiRequests = $this->getApiRequestsPerMinute();
            
            // System Events
            $systemEvents = SystemEvent::latest()
                ->take(5)
                ->get();

            // Recent Payments instead of Transactions
            $recentPayments = Payment::with(['user', 'plan'])
                ->latest()
                ->take(10)
                ->get();
            
            // Get last 4 months revenue data
            $monthlyRevenueData = collect(range(2, 0))->map(function($monthsAgo) {
                $date = now()->subMonths($monthsAgo)->startOfMonth();
                return [
                    'month' => $date->format('M Y'),  // Changed to include year for uniqueness
                    'revenue' => Payment::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->where('status', Payment::STATUS_APPROVED)
                        ->sum('amount')
                ];
            })->values();

            return view('pages.dashboard', compact(
                'totalUsers',
                'totalLicenses',
                'activeLicenses',
                'monthlyRevenue',
                'yearlyRevenue',
                'recentUsers',
                'expiringLicenses',
                'serverLoad',
                'apiRequests',
                'systemEvents',
                'recentPayments',
                'monthlyRevenueData'
            ));
        }

        $licenses = License::where('user_id', auth()->user()->id)->get();
        
        return view('pages.dashboard', compact('licenses'));
    }

    private function getServerLoad()
    {
        if (function_exists('sys_getloadavg')) {
            $load = sys_getloadavg();
            return min(round($load[0] * 100), 100);
        }
        return rand(20, 80); // Fallback for testing
    }

    private function getApiRequestsPerMinute()
    {
        // Implement your API request counting logic here
        // This is a placeholder implementation
        return rand(100, 800);
    }
}
