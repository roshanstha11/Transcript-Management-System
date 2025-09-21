@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="content">
    <div class="p-4">
        <div class="login-container">
            <div class="login-card position-relative">
                <div class="logo-container">
                    <h2 class="text-dark mb-0">Welcome Back</h2>
                    <p class="text-muted">Sign in to your account</p>
                </div>
                <form id="loginForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name"  name="name" placeholder="Full Name" required>
                        <label for="name"><i class="fas fa-person me-2"></i>Full Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password" required>
                        <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                    </div>
                    
                    <div class="form-floating">
                    <div class="mb-4">
                        <div class="row align-items-center g-0">
                            <div class="col-auto">
                                <label for="role" class="form-label mb-0 me-3">Role</label>
                            </div>
                            <div class="col">
                                <select class="form-select" id="role" name="role" required>
                                    <option value="">Select your role...</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-login btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection