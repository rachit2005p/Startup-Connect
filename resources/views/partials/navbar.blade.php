<div class="site-topbar">
    <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
        <span>StartupConnect for student founders, builders, and event communities</span>
        <span>Discover. Register. Build your network.</span>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top main-navbar">
    <div class="container">
        <a class="navbar-brand brand-mark" href="{{ route('home') }}">
            <span>SC</span>
            StartupConnect
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('events.index') }}">Events</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('host-events.create') }}">Host Event</a></li>
                @endauth
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#categories">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-lg-2" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-primary ms-lg-2" type="submit">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
