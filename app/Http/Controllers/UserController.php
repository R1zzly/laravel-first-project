<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function showBalance()
    {
        $user = Auth::user();
        return view('user.balance', compact('user'));
    }

    /**
     * Update the user's balance.
     */
    public function updateBalance(Request $request)
    {
        $request->validate([
            'balance' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        $user->balance = $request->balance;
        $user->save();

        return redirect()->route('user.balance')->with('success', 'Balance updated successfully.');
    }

    public function index()
    {
        $users = User::orderBy('created_at')->get();

        return view('users.index', compact([
            'users'
        ]));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();

        return view('users.edit', compact([
            'user',
            'roles',
        ]));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name
        ]);
        $role = Role::find($request->role_id);

        $user->syncRoles([$role->name]);

        return redirect()->back()->with('status', 'User updated!');
    }

    public function destroy(User $user)
    {
        //
    }
}
