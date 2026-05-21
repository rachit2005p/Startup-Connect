@extends('layouts.app')

@section('title', 'Home | StartupConnect')

@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="hero-label">Campus founders, builders, and curious minds</span>
                <h1 class="display-5 fw-bold mt-3">Discover startup events that help you build, learn, and connect.</h1>
                <p class="lead mt-3">Find hackathons, founder talks, workshops, webinars, internship fairs, and coding contests in one polished platform.</p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('events.index') }}" class="btn btn-light btn-lg">Explore Events</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Join StartupConnect</a>
                </div>
                <div class="hero-stats mt-4">
                    <div><strong>{{ $featuredEvents->count() }}+</strong><span>Featured</span></div>
                    <div><strong>{{ $categories->count() }}+</strong><span>Categories</span></div>
                    <div><strong>24/7</strong><span>Discovery</span></div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero-panel">
                    <span class="panel-kicker">Trending this week</span>
                    <h2 class="h4 fw-bold mt-2">Build your next idea with the right room.</h2>
                    <div class="mini-timeline">
                        <div><span>01</span><p>Find events matched to your interests.</p></div>
                        <div><span>02</span><p>Bookmark sessions worth attending.</p></div>
                        <div><span>03</span><p>Meet founders, mentors, and teammates.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container feature-strip">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="feature-tile">
                <span>Discover</span>
                <p>Browse curated startup events without jumping across multiple sites.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-tile">
                <span>Save</span>
                <p>Keep track of talks, contests, and workshops from your dashboard.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-tile">
                <span>Host</span>
                <p>List your own event and make it easy for students to find it.</p>
            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <div class="section-heading">
        <div>
            <span class="eyebrow">Handpicked opportunities</span>
            <h2 class="section-title">Featured Startup Events</h2>
        </div>
        <a href="{{ route('events.index') }}" class="btn btn-outline-primary">See All Events</a>
    </div>
    <div class="row g-4">
        @forelse($featuredEvents as $event)
            @include('events.card', ['event' => $event])
        @empty
            <p>No events added yet. Login as admin and add the first event.</p>
        @endforelse
    </div>
</section>

<section class="container my-5" id="categories">
    <span class="eyebrow">Explore by interest</span>
    <h2 class="section-title">Categories</h2>
    <div class="row g-3">
        @forelse($categories as $category)
            <div class="col-md-4">
                <a class="text-decoration-none" href="{{ route('events.index', ['category_id' => $category->id]) }}">
                    <div class="category-card p-3 h-100">
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
    <div class="cta-band row align-items-center g-4">
        <div class="col-lg-6">
            <span class="eyebrow">Why it exists</span>
            <h2 class="section-title">About StartupConnect</h2>
            <p>StartupConnect helps students, developers, founders, and early professionals discover useful startup events without searching many websites.</p>
        </div>
        <div class="col-lg-6">
            <div class="cta-card p-4">
                <h3 class="h5">Ready to save events?</h3>
                <p>Create an account and bookmark the events you want to attend.</p>
                <a href="{{ route('register') }}" class="btn btn-primary">Join Now</a>
            </div>
        </div>
    </div>
</section>
@endsection
