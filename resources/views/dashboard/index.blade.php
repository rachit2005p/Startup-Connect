@extends('layouts.app')

@section('title', 'Dashboard | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="card p-4 mb-4">
        <h1 class="h3">Welcome, {{ auth()->user()->name }}</h1>
        <p class="mb-1"><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p class="mb-3">Your saved, registered, and hosted startup events are listed below.</p>
        <a class="btn btn-success" href="{{ route('host-events.create') }}">Host a New Event</a>
    </div>

    <h2 class="section-title">Events You Hosted</h2>
    <div class="row g-4 mb-5">
        @forelse($hostedEvents as $event)
            @include('events.card', ['event' => $event, 'showHostActions' => true])
        @empty
            <p>You have not hosted any events yet.</p>
        @endforelse
    </div>

    <h2 class="section-title">Registered Events</h2>
    <div class="row g-4 mb-5">
        @forelse($registeredEvents as $event)
            @include('events.card', ['event' => $event])
        @empty
            <p>You have not registered for any events yet.</p>
        @endforelse
    </div>

    <h2 class="section-title">Bookmarked Events</h2>
    <div class="row g-4">
        @forelse($bookmarkedEvents as $event)
            @include('events.card', ['event' => $event])
        @empty
            <p>You have not bookmarked any events yet.</p>
        @endforelse
    </div>
</section>
@endsection
