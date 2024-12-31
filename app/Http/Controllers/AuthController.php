<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\DatabaseOperationsTrait;

class AuthController extends Controller
{
    use DatabaseOperationsTrait;
    // Handle User Registration
    public function register(Request $request,User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5',
        ]);

        $this->storeRecord($user,[
            'name' => $request->name,
            'email' => $request->email,
            'role' => 2,
            'password' => Hash::make($request->password),
        ]);

        // Optionally log in the user after signup
        if (Auth::attempt($request->only('email', 'password'))) {
            if(Auth::user()->role == 1) {
                return redirect()->route('user.all');
            } else {
                return redirect()->route('rooms');
            }
            
        }
    }

    // Handle User Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            if(Auth::user()->role == 1) {
                return redirect()->route('user.all');
            } else {
                return redirect()->route('rooms');
            }
            
        }
        return back()->with([
            'error' => 'Invalid credentials.',
        ]);
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
