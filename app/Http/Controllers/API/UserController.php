<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request): Response {
        $this->authorizeAdmin();
        $users = User::whereNotIn('id', [auth()->user()->id, 1])->get();
        return Inertia::render('users/list', [
            'list' => $users
        ]);
    }

    public function create(Request $request): Response {
        $this->authorizeAdmin();
        $roles = [
            // array("label" => "Admin", "value" => "admin"),
            array("label" => "User", "value" => "user"),
            array("label" => "Shop Owner", "value" => "shop owner"),
            array("label" => "Maintanance", "value" => "maintanance"),
        ];
        return Inertia::render('users/user', [
            'roles' => $roles
        ]);
    }

    public function edit(Request $request, $id): Response {
        $this->authorizeAdmin();
        $roles = [
            // array("label" => "Admin", "value" => "admin"),
            array("label" => "User", "value" => "user"),
            array("label" => "Shop Owner", "value" => "shop owner"),
            array("label" => "Maintanance", "value" => "maintanance"),
        ];
        return Inertia::render('users/user', [
            'roles' => $roles,
            'user' => User::find($id)
        ]);
    }

    public function store(Request $request): RedirectResponse {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return to_route('users');
    }
    public function update(Request $request, $id): RedirectResponse {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin,shop_owner,maintanance',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return to_route('users');
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        $this->authorizeAdmin();
        $user = User::find($id);

        $user->delete();

        return to_route('users');
    }

    private function authorizeAdmin() {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Access denied');
        }
    }
}
