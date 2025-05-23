<?php

namespace App\Http\Controllers;

use App\Models\Plan;

class LandingController extends Controller
{
    public function index()
    {
        // get active plans except for the one with id 1
        $plans = Plan::active()
            ->where('id', '!=', 1)
            ->orderBy('price')
            ->get();
        return view('pages.landing', compact('plans'));
    }
}
