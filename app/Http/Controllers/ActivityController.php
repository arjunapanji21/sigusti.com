<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $query = Activity::with(['license.user'])->latest();
        
        if (!auth()->user()->is_admin) {
            // Regular users can only see their own activities
            $query->whereHas('license', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }
        
        $activities = $query->paginate(20);
        return view('pages.activity.index', compact('activities'));
    }

    public function show(Activity $activity)
    {
        if (!auth()->user()->is_admin && $activity->license->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('pages.activity.show', compact('activity'));
    }
}
