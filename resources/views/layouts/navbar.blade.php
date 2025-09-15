

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
                    <a type="button" class="btn btn-info" href="{{ route('login-form') }}">Log In</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


