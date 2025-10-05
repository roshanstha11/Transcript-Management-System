<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $users = User::all();

        // Quick stats
        $totalUsers = $users->count();
        $admins = $users->where('role', 'admin')->count();
        $superAdmins = $users->where('role', 'super_admin')->count();
        // $user = $users->where('role', 'user')->count();

        // Recent activity logs
        $activities = ActivityLog::with('user')->latest()->take(10)->get();

        return view('superadmin.dashboard', compact(
            'users',
            'totalUsers',
            'admins',
            'superAdmins',
            'activities',
        ));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $oldRole = $user->role; // store current role before update
        $newRole = $request->role;

        $user->role = $newRole;
        $user->save();

        // Log the role change
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated role for user email: ' . $user->email . ' from ' . ucfirst($oldRole) . ' to ' . ucfirst($newRole),
        ]);

        return back()->with('success', 'User role updated successfully.');
    }

}
