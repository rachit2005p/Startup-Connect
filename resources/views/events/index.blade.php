@extends('layouts.app')

@section('title', 'Events | StartupConnect')

@section('content')
<section class="container my-5" id="categories">
    <h1 class="section-title">Startup Events</h1>
    <form class="card p-3 mb-4" method="GET" action="{{ route('events.index') }}">
        <div class="row g-3">
            <div class="col-md-4">
                <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Search by title">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="category_id">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="mode">
                    <option value="">All modes</option>
                    <option value="online" @selected(request('mode') === 'online')>Online</option>
                    <option value="offline" @selected(request('mode') === 'offline')>Offline</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse($events as $event)
            @include('events.card', ['event' => $event])
        @empty
            <div class="col-12">
                <div class="alert alert-info">No matching events found.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">{{ $events->links() }}</div>
</section>
@endsection
