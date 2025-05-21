<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with(['license.user'])
            ->latest()
            ->paginate(20);
        
        return view('activities.index', compact('activities'));
    }
}
