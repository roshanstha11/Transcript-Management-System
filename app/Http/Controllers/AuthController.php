<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{    
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('index')->with('success', 'Login successful');
            // return redirect()->intended('/dashboard'); // or home route

            // Redirect based on role
            if (Auth::user()->role === 'superadmin') {
                echo "superadmin";
                // return redirect()->route('superadmin.dashboard');
            } elseif (Auth::user()->role === 'admin') {
                echo "admin";
                // return redirect()->route('admin.dashboard');
            } else {
                echo "user";
                // return redirect()->route('user.dashboard');
            }

        }
        
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string|same:password',
            'role' => 'sometimes|string|in:super_admin,admin,user',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // role from form
        ]);
        
        // Auth::login($user);
        return redirect()->route('login')->with('success', 'Registration successful! Please login.'); // or home route
    }

}
