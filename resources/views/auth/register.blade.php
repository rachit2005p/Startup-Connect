@extends('layouts.app')

@section('title', 'Register | StartupConnect')

@section('content')
<section class="auth-page">
    <div class="container">
        <div class="row align-items-center justify-content-center g-4">
            <div class="col-lg-5">
                <div class="auth-copy">
                    <span class="eyebrow">Start your network</span>
                    <h1>Create a sharper way to discover startup opportunities.</h1>
                    <p>Join StartupConnect to save events, register faster, and stay close to workshops, hackathons, and founder sessions.</p>
                    <div class="auth-points">
                        <span>Save events</span>
                        <span>Track registrations</span>
                        <span>Host your own event</span>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-lg-5">
            <div class="auth-card p-4">
                <h2 class="h3 mb-2">Create Account</h2>
                <p class="text-muted mb-4">A free account keeps your startup calendar organized.</p>
                <form method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="password-field">
                            <input id="register-password" class="form-control" type="password" name="password" autocomplete="new-password" aria-describedby="passwordHelp">
                            <button class="password-toggle" type="button" data-password-toggle="register-password" aria-label="Show password">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2.25 12s3.5-6.25 9.75-6.25S21.75 12 21.75 12 18.25 18.25 12 18.25 2.25 12 2.25 12Z"></path>
                                    <circle cx="12" cy="12" r="2.75"></circle>
                                </svg>
                            </button>
                        </div>
                        <div id="passwordHelp" class="form-text">Use at least 6 characters. A mix of letters, numbers, and symbols is stronger.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <div class="password-field">
                            <input id="register-password-confirmation" class="form-control" type="password" name="password_confirmation" autocomplete="new-password">
                            <button class="password-toggle" type="button" data-password-toggle="register-password-confirmation" aria-label="Show password">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2.25 12s3.5-6.25 9.75-6.25S21.75 12 21.75 12 18.25 18.25 12 18.25 2.25 12 2.25 12Z"></path>
                                    <circle cx="12" cy="12" r="2.75"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Register</button>
                </form>
                <p class="mt-3 mb-0">Already registered? <a href="{{ route('login') }}">Login instead</a></p>
            </div>
            </div>
        </div>
    </div>
</section>
@endsection
