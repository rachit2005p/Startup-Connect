@extends('layouts.app')

@section('title', $event->title . ' | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="row g-4">
        <div class="col-lg-7">
            @if($event->image)
                <img class="img-fluid rounded detail-image w-100" src="{{ asset('uploads/' . $event->image) }}" alt="{{ $event->title }}">
            @else
                <div class="detail-image bg-secondary-subtle rounded d-flex align-items-center justify-content-center">
                    <span class="text-secondary">Startup Event</span>
                </div>
            @endif
        </div>
        <div class="col-lg-5">
            <span class="badge bg-info text-dark">{{ $event->category->category_name }}</span>
            <span class="badge bg-success badge-mode">{{ $event->mode }}</span>
            <h1 class="mt-3">{{ $event->title }}</h1>
            <p class="text-muted">{{ $event->description }}</p>
            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Date:</strong> {{ $event->event_date->format('d M Y') }}</li>
                <li class="list-group-item"><strong>Time:</strong> {{ \Illuminate\Support\Str::limit($event->event_time, 5, '') }}</li>
                <li class="list-group-item"><strong>Location:</strong> {{ $event->location }}</li>
                <li class="list-group-item"><strong>Organizer:</strong> {{ $event->organizer }}</li>
            </ul>

            @auth
                @if($isRegistered)
                    <form class="d-inline" method="POST" action="{{ route('event-registrations.destroy', $event) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-warning" type="submit">Cancel Registration</button>
                    </form>
                @else
                    <form class="d-inline" method="POST" action="{{ route('event-registrations.store', $event) }}">
                        @csrf
                        <button class="btn btn-primary" type="submit">Register for Event</button>
                    </form>
                @endif

                @if($isBookmarked)
                    <form class="d-inline" method="POST" action="{{ route('bookmarks.destroy', $event) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit">Remove Bookmark</button>
                    </form>
                @else
                    <form class="d-inline" method="POST" action="{{ route('bookmarks.store', $event) }}">
                        @csrf
                        <button class="btn btn-outline-success" type="submit">Bookmark</button>
                    </form>
                @endif
            @else
                <a class="btn btn-primary" href="{{ route('login') }}">Login to Register</a>
                <a class="btn btn-outline-success" href="{{ route('login') }}">Login to Bookmark</a>
            @endauth
        </div>
    </div>
</section>
@endsection
