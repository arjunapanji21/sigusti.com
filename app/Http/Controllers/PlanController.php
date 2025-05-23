<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::orderBy('price')->get();
        return view('pages.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('pages.plans.edit');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'duration_days' => 'required|integer|min:1',
            'daily_limit' => 'required|integer|min:0',
            'monthly_limit' => 'required|integer|min:0',
            'max_device' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        Plan::create($validated);
        return redirect()->route('plans.index')->with('success', 'Plan created successfully');
    }

    public function show(Plan $plan)
    {
        return view('pages.plans.show', compact('plan'));
    }

    public function edit(Plan $plan)
    {
        return view('pages.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'duration_days' => 'required|integer|min:1',
            'daily_limit' => 'required|integer|min:0',
            'monthly_limit' => 'required|integer|min:0',
            'max_device' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $plan->update($validated);
        return redirect()->route('plans.index')->with('success', 'Plan updated successfully');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'Plan deleted successfully');
    }
}
