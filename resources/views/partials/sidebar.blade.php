<!-- Sidebar -->
<div id="sidebar" class="p-3 bg-light collapsed">
    <button id="toggle-btn">
        <i class="bi bi-chevron-right"></i> <!-- default icon -->
    </button>
    <ul class="nav flex-column mt-5">
        @auth
        @if(Auth::user()->role === 'super_admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('superadmin.dashboard') }}"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('view-all-record')}}"><i class="bi bi-view-list"></i> <span>View Records</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index')}}"><i class="bi bi-person-fill-gear"></i> <span>User Management</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-info-circle"></i> <span>About</span></a>
            </li>
        @elseif(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('superadmin.dashboard') }}"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('view-all-record')}}"><i class="bi bi-view-list"></i> <span>View Records</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index')}}"><i class="bi bi-person-fill-gear"></i> <span>User Management</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-info-circle"></i> <span>About</span></a>
            </li>
        @elseif(Auth::user()->role === 'user')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('create-form') }}"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('view-all-record')}}"><i class="bi bi-house-door"></i> <span>Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-gear"></i> <span>Settings</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-info-circle"></i> <span>About</span></a>
            </li>
        @endif
        @endauth
    </ul>
</div>

