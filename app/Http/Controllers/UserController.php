<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        $users = User::all();
        return view('users.index', compact('users', 'user'));
    }

    // Show create user form
    public function create()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('users.create',  compact('user'));
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'mobile' => 'required|digits:10|unique:users', // Mobile validation
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile, // Save mobile number
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    // Show edit user form
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'mobile' => 'required|digits:10|unique:users,mobile,' . $user->id, // Ensure unique mobile
            'role' => 'required|in:user,admin,owner'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'mobile' => $request->mobile, // Update mobile number
            'role' => $request->role, 
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
