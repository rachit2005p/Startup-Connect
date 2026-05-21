@extends('layouts.app')

@section('title', 'Home | StartupConnect')

@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <h1 class="display-5 fw-bold">Discover startup events that help you build, learn, and connect.</h1>
                <p class="lead mt-3">Find hackathons, founder talks, workshops, webinars, internship fairs, and coding contests in one simple platform.</p>
                <a href="{{ route('events.index') }}" class="btn btn-light btn-lg mt-3">Explore Events</a>
            </div>
            <div class="col-lg-5">
                <div class="p-4 bg-white text-dark rounded-3">
                    <h2 class="h5 fw-bold">Popular event types</h2>
                    <p class="mb-0">Hackathons, startup meetups, workshops, founder talks, coding contests, internship fairs, webinars, and entrepreneurship seminars.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <h2 class="section-title">Featured Startup Events</h2>
    <div class="row g-4">
        @forelse($featuredEvents as $event)
            @include('events.card', ['event' => $event])
        @empty
            <p>No events added yet. Login as admin and add the first event.</p>
        @endforelse
    </div>
</section>

<section class="container my-5" id="categories">
    <h2 class="section-title">Categories</h2>
    <div class="row g-3">
        @forelse($categories as $category)
            <div class="col-md-4">
                <a class="text-decoration-none" href="{{ route('events.index', ['category_id' => $category->id]) }}">
                    <div class="card p-3 h-100">
                        <h3 class="h5 text-dark">{{ $category->category_name }}</h3>
                        <p class="text-muted mb-0">{{ $category->events_count }} events</p>
                    </div>
                </a>
            </div>
        @empty
            <p>No categories available yet.</p>
        @endforelse
    </div>
</section>

<section class="container my-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <h2 class="section-title">About StartupConnect</h2>
            <p>StartupConnect helps students, developers, founders, and early professionals discover useful startup events without searching many websites.</p>
        </div>
        <div class="col-lg-6">
            <div class="card p-4">
                <h3 class="h5">Ready to save events?</h3>
                <p>Create an account and bookmark the events you want to attend.</p>
                <a href="{{ route('register') }}" class="btn btn-primary">Join Now</a>
            </div>
        </div>
    </div>
</section>
@endsection
