<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            // Admin view - see all non-admin users
            $users = User::where('is_admin', false)->paginate(10);
            return view('pages.users.index', compact('users'));
        } else {
            // Regular user view - redirect to their profile
            return redirect()->route('profile.edit');
        }
    }

    public function show(User $user)
    {
        if (!auth()->user()->is_admin && auth()->id() !== $user->id) {
            abort(403, 'Unauthorized access.');
        }

        return view('pages.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->user()->is_admin && auth()->id() !== $user->id) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'User updated successfully.');
    }
}
