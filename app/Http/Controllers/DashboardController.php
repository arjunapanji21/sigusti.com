<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            $totalUsers = User::where('is_admin', false)->count();
            $totalLicenses = License::count();
            $activeLicenses = License::where('expires_at', '>', now())->count();
            $recentUsers = User::where('is_admin', false)
                ->latest()
                ->take(5)
                ->get();
            $expiringLicenses = License::where('expires_at', '>', now())
                ->where('expires_at', '<', now()->addDays(30))
                ->with('user')
                ->take(5)
                ->get();
            
            return view('pages.dashboard', compact(
                'totalUsers',
                'totalLicenses',
                'activeLicenses',
                'recentUsers',
                'expiringLicenses'
            ));
        }

        $licenses = License::where('user_id', auth()->id())->get();
        
        return view('pages.dashboard', compact('licenses'));
    }
}
