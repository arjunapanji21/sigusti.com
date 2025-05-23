<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Events\SupportTicketCreated;

class SupportController extends Controller
{
    public function index()
    {
        return view('pages.support');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $support = Support::create([
            'user_id' => auth()->id(),
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'priority' => $validated['priority'],
            'status' => 'open'
        ]);

        // Optional: Dispatch event for notifications
        // event(new SupportTicketCreated($support));

        return back()->with('success', 'Your support ticket has been submitted. We\'ll get back to you soon.');
    }
}
