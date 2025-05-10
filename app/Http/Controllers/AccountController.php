<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    // Display all accounts
    public function index(Request $request)
    {
        //$accounts = User::all();
        //Log::info('Fetched accounts:', $accounts->toArray());
        $role = ['admin', 'employee', 'client'];

        $search=$request->input('search');
        $accounts = User:: when ($search, function($query,$search){
            return $query->where('name', 'like',"%$search%")
                        ->orWhere('role','like',"%$search%")
                        ->orWhere('email','like',"%$search%");
        })->paginate(10);
        return view('dashboard', compact('accounts', 'role','search'));
    }

    // Store new account
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'client'; // Default role

        User::create($validated);

        return redirect()->route('dashboard')->with('success', 'Account added successfully');
    }

    // Update account info
    public function update(Request $request, $id)
    {
        $account = User::findOrFail($id);

        $validated = $request->validate([
            'password' => 'nullable|string|min:8',
        ]);

        // Allow role update only for admins
        if (auth()->check() && auth()->user()->role === 'admin') {
            $roleValidated = $request->validate([
                'role' => 'required|in:admin,employee,client',
            ]);
            $validated['role'] = $roleValidated['role'];
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Don't overwrite with null
        }

        $account->update($validated);

        return redirect()->route('dashboard')->with('success', 'Account updated successfully');
    }

    // Delete account
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('dashboard')->with('success', 'Account deleted successfully');
    }
}
