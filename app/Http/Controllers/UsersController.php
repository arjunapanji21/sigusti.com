<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\LicenseActivity;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('profile.edit');
        }

        $query = User::query()
            ->where('is_admin', false)
            ->when($request->filled('search'), function($query) use ($request) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest();
        
        $users = $query->paginate(10)
            ->withQueryString();

        return view('pages.users.index', compact('users'));
    }

    public function show(User $user)
    {
        if (!auth()->user()->is_admin && auth()->user()->id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }

        // get user's total licenses
        $totalLicenses = $user->licenses()
            ->where('expires_at', '>', now())
            ->count();

        // get user's total payments
        $totalPayments = $user->payments()
            ->where('status', Payment::STATUS_APPROVED)
            ->sum('amount');

        // get last license activity created_at of this user
        $lastLicenseActivity = LicenseActivity::whereIn('license_id', $user->licenses()->pluck('id'))
            ->latest()
            ->first();


        return view('pages.users.show', compact('user', 'totalLicenses', 'totalPayments', 'lastLicenseActivity'));
    }

    public function edit(User $user)
    {
        if (!auth()->user()->is_admin && auth()->user()->id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }

        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->user()->is_admin && auth()->user()->id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users-' . now()->format('Y-m-d') . '.xlsx');
    }
}
