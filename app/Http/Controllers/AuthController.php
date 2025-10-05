<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
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
            
            // ✅ Log activity here
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Logged in',
            ]);

            return redirect()->route('superadmin.dashboard')->with('success', 'Login successful');
        }
        
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }
    
    public function logout(Request $request)
    {
        // ✅ capture user info before logout
        $user = Auth::user();

        if ($user) {
            ActivityLog::create([
                'user_id' => $user->id,
                'action'  => 'Logged out',
            ]);
        }

        // perform logout
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Logged out successfully.');
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

        // ✅ Log activity here
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'User created: ' . $user->email,
        ]);
        
        return redirect()->route('login')->with('success', 'Registration successful! Please login.'); // or home route
    }

}
