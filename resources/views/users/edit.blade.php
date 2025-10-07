@extends('layouts.app')

@section('content')
<div class="content">
    <div class="p-4">
        <div class="login-container">
            <div class="login-card position-relative">
                <div class="logo-container">
                    <h2 class="text-dark mb-0">Edit User</h2>
                </div>

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" value="{{ old('name', $user->name) }}" name="name" placeholder="Full Name" required>
                        <label for="name"><i class="fas fa-person me-2"></i>Full Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" name="email" placeholder="name@example.com" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                    </div>
                    <div class="form-floating">
                        <div class="mb-4">
                            <div class="row align-items-center g-0">
                                <div class="col-auto">
                                    <label for="role" class="form-label mb-0 me-3">Role</label>
                                </div>
                                <div class="col">
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                                        <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                                        <option value="super_admin" {{ $user->role=='super_admin'?'selected':'' }}>Super Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a type="button" href="javascript:history.back()" class="btn btn-secondary w-40 mx-4">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
