@extends('layouts.app')

@section('title', 'Register | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h1 class="h3 mb-3">Create Account</h1>
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
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation">
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
