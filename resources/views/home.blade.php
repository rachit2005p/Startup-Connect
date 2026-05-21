@extends('layouts.app')

@section('title', 'Home | StartupConnect')

@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <span class="hero-label">Student startup ecosystem</span>
                <h1 class="display-5 fw-bold mt-3">Find events that move your idea forward.</h1>
                <p class="lead mt-3">StartupConnect brings hackathons, founder talks, workshops, coding contests, internship fairs, and campus meetups into one focused platform.</p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('events.index') }}" class="btn btn-orange btn-lg">Explore Events</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Create Account</a>
                </div>
                <div class="hero-stats mt-4">
                    <div><strong>{{ $featuredEvents->count() }}</strong><span>Featured events</span></div>
                    <div><strong>{{ $categories->count() }}</strong><span>Categories</span></div>
                    <div><strong>Live</strong><span>Community access</span></div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="hero-panel">
                    <img src="{{ asset('uploads/founder-talk-mvp.png') }}" alt="Founder talk event" class="hero-panel-image">
                    <div class="hero-panel-body">
                        <span class="panel-kicker">Recommended journey</span>
                        <h2 class="h4 fw-bold mt-2">Learn, meet, build, and launch.</h2>
                        <div class="journey-steps">
                            <span>Ideation</span>
                            <span>Validation</span>
                            <span>Traction</span>
                        </div>
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
                <span class="feature-icon">01</span>
                <h3>Discover Events</h3>
                <p>Find useful startup events without searching multiple websites.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-tile">
                <span class="feature-icon">02</span>
                <h3>Save Opportunities</h3>
                <p>Bookmark talks, contests, and workshops you want to attend.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-tile">
                <span class="feature-icon">03</span>
                <h3>Host Programs</h3>
                <p>Publish your event and help students join the right sessions.</p>
            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <div class="startup-stage">
        <div class="stage-menu">
            <div class="active"><span></span> Ideation</div>
            <div>Validation</div>
            <div>Early Traction</div>
            <div>Scaling</div>
        </div>
        <div class="stage-content">
            <span class="eyebrow">Startup pathway</span>
            <h2>Resources for every stage of your idea.</h2>
            <p>Use events as your practical startup roadmap: learn basics, test your concept, meet collaborators, and find momentum.</p>
            <div class="stage-links">
                <a href="{{ route('events.index', ['category_id' => $categories->firstWhere('category_name', 'Workshop')->id ?? null]) }}">Workshops</a>
                <a href="{{ route('events.index', ['category_id' => $categories->firstWhere('category_name', 'Founder Talk')->id ?? null]) }}">Founder Talks</a>
                <a href="{{ route('events.index', ['category_id' => $categories->firstWhere('category_name', 'Hackathon')->id ?? null]) }}">Hackathons</a>
                <a href="{{ route('events.index') }}">All Events</a>
            </div>
        </div>
        <div class="stage-visual">
            <img src="{{ asset('uploads/campus-startup-hackathon.png') }}" alt="Startup hackathon">
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
    <div class="section-heading">
        <div>
            <span class="eyebrow">Explore by interest</span>
            <h2 class="section-title">Categories</h2>
        </div>
    </div>
    <div class="row g-3">
        @forelse($categories as $category)
            <div class="col-md-4">
                <a class="text-decoration-none" href="{{ route('events.index', ['category_id' => $category->id]) }}">
                    <div class="category-card h-100">
                        <span class="category-dot"></span>
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
            <span class="eyebrow">Why students use it</span>
            <h2 class="section-title">About StartupConnect</h2>
            <p>StartupConnect helps students, developers, founders, and early professionals discover useful startup events without searching many websites.</p>
        </div>
        <div class="col-lg-6">
            <div class="cta-card">
                <h3 class="h5">Ready to save your next opportunity?</h3>
                <p>Create an account, bookmark events, and keep your startup calendar organized.</p>
                <a href="{{ route('register') }}" class="btn btn-primary">Join Now</a>
            </div>
        </div>
    </div>
</section>
@endsection
