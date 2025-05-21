<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::paginate(10);
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        return view('admin.subscriptions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'daily_limit' => 'required|integer|min:1',
            'monthly_limit' => 'required|integer|min:1',
            'duration_in_days' => 'required|integer|min:1',
            'features' => 'nullable|array'
        ]);

        Subscription::create($validated);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription plan created successfully.');
    }

    public function edit(Subscription $subscription)
    {
        return view('admin.subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'daily_limit' => 'required|integer|min:1',
            'monthly_limit' => 'required|integer|min:1',
            'duration_in_days' => 'required|integer|min:1',
            'features' => 'nullable|array'
        ]);

        $subscription->update($validated);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription plan updated successfully.');
    }
}
