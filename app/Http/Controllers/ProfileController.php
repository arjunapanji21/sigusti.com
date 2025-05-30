<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user = auth()->user();
        $user->update([
            'name' => ucwords(strtolower($request->name)),
            'email' => strtolower($request->email),
            'phone' => $request->phone,
        ]);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => \Hash::make($request->password)]);

        return redirect()->route('profile.index')->with('success', 'Password changed successfully.');
    }
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Password is incorrect.']);
        }

        // Perform any additional cleanup if necessary
        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
    public function showDeleteAccountForm()
    {
        return view('pages.profile.delete_account');
    }
    public function showChangePasswordForm()
    {
        return view('pages.profile.change_password');
    }
}
