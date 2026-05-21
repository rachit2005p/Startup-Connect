@extends('layouts.app')

@section('title', 'Login | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h1 class="h3 mb-3">Login</h1>
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                </form>
                <p class="mt-3 mb-0">New user? <a href="{{ route('register') }}">Create an account</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
