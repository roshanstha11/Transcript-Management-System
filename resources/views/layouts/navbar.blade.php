

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/kulogo.png') }}" alt="KU Logo" height="80" class="ps-5">
        </a>
        @auth
        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-link text-white text-decoration-none d-flex align-items-center gap-2 p-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                        <i class="bi bi-person-fill text-white"></i>
                    </div>
                    <span class="fw-medium">{{ Auth::user()->email }}</span>
                    <i class="bi bi-chevron-down"></i>
                </button>
                
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-3" style="min-width: 280px;">
                    <li class="dropdown-header px-0 pb-3 mb-3 border-bottom">
                        <div class="fw-bold text-dark mb-2">Name: {{ Auth::user()->name }}</div>
                        <div class="badge bg-light text-dark rounded-pill">Role: {{ Auth::user()->role }}</div>
                    </li>
                    
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            {{-- <button type="submit" class="dropdown-item">Logout</button> --}}
                            <button type="submit" class="dropdown-item d-flex align-items-center gap-3 py-2 px-3 rounded-2 text-danger" onclick="return confirm('Are you sure you want Logout?');">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @endauth
        {{-- <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    @auth
                    <div class="btn-group">
                        <button class="btn btn-info dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->email }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item">Name: {{ Auth::user()->name }}</a></li>
                            <li><a class="dropdown-item">Role: {{ Auth::user()->role }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth
                </li>
            </ul>
        </div> --}}
    </div>
</nav>


