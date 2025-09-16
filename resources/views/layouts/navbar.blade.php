

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/kulogo.png') }}" alt="KU Logo" height="80" class="ps-5">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    {{-- If the user is not logged in --}}
                    @guest
                    <a type="button" class="btn btn-info" href="{{ route('login') }}">Log In</a>
                    <a type="button" class="btn btn-info" href="{{ route('register') }}">Register</a>
                    @endguest
                    {{-- If the user is logged in --}}
                    @auth
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
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
        </div>
    </div>
</nav>


