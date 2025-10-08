@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="content" style="flex: 1;">
    <div class="p-4">
        <div class="login-container">
            <div class="login-card position-relative">
                <div class="logo-container">
                    <h2 class="text-dark mb-0">Welcome Back</h2>
                    <p class="text-muted">Sign in to your account</p>
                </div>
                <form id="loginForm" method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                        <!-- Eye Icon -->
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor:pointer;">
                            <i class="fas fa-eye" id="eyeIconPassword"></i>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-login btn-primary w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('scripts')
<script>
    function toggleVisibility(passwordId, iconId) {
        const passwordField = document.getElementById(passwordId);
        const icon = document.getElementById(iconId);
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }

    document.getElementById('togglePassword').addEventListener('click', () => {
        toggleVisibility('password', 'eyeIconPassword');
    });
</script>
@endsection