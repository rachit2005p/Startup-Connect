@extends('layouts.app')

@section('title', 'Login | StartupConnect')

@section('content')
<section class="auth-page">
    <div class="container">
        <div class="row align-items-center justify-content-center g-4">
            <div class="col-lg-5">
                <div class="auth-copy">
                    <span class="eyebrow">Welcome back</span>
                    <h1>Pick up where your next idea left off.</h1>
                    <p>Login to bookmark events, manage registrations, and keep your startup learning plan in one place.</p>
                    <div class="auth-points">
                        <span>Curated events</span>
                        <span>Saved bookmarks</span>
                        <span>Founder-friendly dashboard</span>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-lg-5">
            <div class="auth-card p-4">
                <h2 class="h3 mb-2">Login</h2>
                <p class="text-muted mb-4">Enter your details to continue to StartupConnect.</p>
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="password-field">
                            <input id="login-password" class="form-control" type="password" name="password" autocomplete="current-password">
                            <button class="password-toggle" type="button" data-password-toggle="login-password" aria-label="Show password">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2.25 12s3.5-6.25 9.75-6.25S21.75 12 21.75 12 18.25 18.25 12 18.25 2.25 12 2.25 12Z"></path>
                                    <circle cx="12" cy="12" r="2.75"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                </form>
                <p class="mt-3 mb-0">New user? <a href="{{ route('register') }}">Create an account</a></p>
            </div>
            </div>
        </div>
    </div>
</section>
@endsection
