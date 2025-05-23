<?php

namespace App\Http\Controllers;

use App\Models\Plan;

class LandingController extends Controller
{
    public function index()
    {
        $plans = Plan::active()->orderBy('price')->get();
        return view('pages.landing', compact('plans'));
    }
}
