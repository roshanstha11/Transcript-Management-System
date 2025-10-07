@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <h2 class="text-center mb-4 mt-4">Super Admin Dashboard</h2> -->
    <h2 class="text-center mb-4 mt-4">Welcome To</br> Kathmandu University School of Medical Sciences</h2>

    {{-- Stats Section --}}
    <div class="row m-5">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h3>{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Admins</h5>
                    <h3>{{ $admins }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Super Admins</h5>
                    <h3>{{ $superAdmins }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Role Management --}}
    <h4>Manage User Roles</h4>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Current Role</th>
                <th>Change Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Recent Activity --}}
    <h4 class="mt-4">Recent Activity</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User Email</th>
                <th>Action</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($activities as $activity)
            <tr>
                <td>{{ $activity->user->email }}</td>
                <td>{{ $activity->action }}</td>
                <td>{{ $activity->created_at->diffForHumans() }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">No activity yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
