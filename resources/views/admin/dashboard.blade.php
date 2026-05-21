@extends('layouts.app')

@section('title', 'Admin Panel | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h1 class="section-title mb-0">Admin Panel</h1>
        <div>
            <a class="btn btn-success" href="{{ route('admin.events.create') }}">Add Event</a>
            <a class="btn btn-outline-primary" href="{{ route('admin.categories.index') }}">Manage Categories</a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6"><div class="card p-3"><h2 class="h5">Total Events</h2><p class="display-6 mb-0">{{ $eventCount }}</p></div></div>
        <div class="col-md-6"><div class="card p-3"><h2 class="h5">Total Categories</h2><p class="display-6 mb-0">{{ $categoryCount }}</p></div></div>
    </div>

    <div class="card p-3">
        <h2 class="h4">Events</h2>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Mode</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->category->category_name ?? 'None' }}</td>
                            <td>{{ $event->event_date->format('d M Y') }}</td>
                            <td>{{ ucfirst($event->mode) }}</td>
                            <td>
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.events.show', $event) }}">View</a>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.events.edit', $event) }}">Edit</a>
                                <form class="d-inline" method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Delete this event?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No events created yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
