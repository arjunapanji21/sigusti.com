<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        $licenses = auth()->user()->can('admin-actions') 
            ? License::with(['user', 'plan'])->latest()->paginate(10)
            : License::where('user_id', auth()->id())->with(['plan'])->latest()->paginate(10);

        return view('pages.licenses.index', compact('licenses'));
    }

    public function show(License $license)
    {
        if (!auth()->user()->can('admin-actions') && $license->user_id !== auth()->id()) {
            abort(403);
        }

        $license->load(['user', 'plan', 'activities']);
        return view('pages.licenses.show', compact('license'));
    }

    public function activate(License $license)
    {
        $license->update(['is_active' => true]);
        return back()->with('success', 'License activated successfully');
    }

    public function deactivate(License $license)
    {
        $license->update(['is_active' => false]);
        return back()->with('success', 'License deactivated successfully');
    }
}
