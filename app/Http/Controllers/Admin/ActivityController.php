<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with(['license.user'])
            ->latest()
            ->paginate(20);
        
        return view('admin.activities.index', compact('activities'));
    }
}
