@extends('layouts.app')

@section('title', 'Contact | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card p-4">
                <h1 class="h3 mb-3">Contact Us</h1>
                <form method="POST" action="{{ route('contact.store') }}">
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
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" rows="5">{{ old('message') }}</textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
