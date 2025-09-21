<!-- Sidebar -->
<div id="sidebar" class="p-3 bg-light">
    <button id="toggle-btn">
        <i class="bi bi-list"></i> <!-- default icon -->
    </button>
    <ul class="nav flex-column mt-5">
        <li class="nav-item">
        <a class="nav-link" href="{{ route('show-form')}}"><i class="bi bi-house-door"></i> <span>Home</span></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi bi-gear"></i> <span>Settings</span></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi bi-info-circle"></i> <span>About</span></a>
        </li>
    </ul>
</div>

