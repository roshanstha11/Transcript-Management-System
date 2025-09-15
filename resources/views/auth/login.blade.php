@extends('layouts.app')
@section('title', 'Login')
@section('content')

<div class="login-container">
    <div class="login-card position-relative">
        <div class="logo-container">
            <h2 class="text-dark mb-0">Welcome Back</h2>
            <p class="text-muted">Sign in to your account</p>
        </div>
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            <div class="form-floating">
                <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
            </div>
            <button type="submit" class="btn btn-login btn-primary w-100">
                <i class="fas fa-sign-in-alt me-2"></i>Sign In
            </button>
        </form>
    </div>
</div>
@endsection