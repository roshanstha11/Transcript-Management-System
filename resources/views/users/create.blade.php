@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="content">
    <div class="p-4">
        <div class="login-container">
            <div class="login-card position-relative">
                <div class="logo-container">
                    <h2 class="text-dark mb-0">Register New User</h2>
                </div>
                <form id="loginForm" method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name"  name="name" placeholder="Full Name" required>
                        <label for="name"><i class="fas fa-person me-2"></i>Full Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                    </div>
                    <div class="form-floating position-relative">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                        <!-- Eye Icon -->
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor:pointer;">
                            <i class="fas fa-eye" id="eyeIconPassword"></i>
                        </span>
                    </div>
                    <div class="form-floating position-relative">
                        <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" placeholder="Confirm Password" required>
                        <label for="confirmPassword"><i class="fas fa-lock me-2"></i>Confirm Password</label>

                        <!-- Eye Icon -->
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" id="toggleConfirmPassword" style="cursor:pointer;">
                            <i class="fas fa-eye" id="eyeIconConfirm"></i>
                        </span>
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
                    <button type="submit" class="btn btn-login btn-primary w-40">Register</button>
                    <a type="button" href="javascript:history.back()" class="btn btn-login btn-secondary w-40 mx-4">Cancel</a>
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

    document.getElementById('toggleConfirmPassword').addEventListener('click', () => {
        toggleVisibility('confirmPassword', 'eyeIconConfirm');
    });
</script>

@endsection
