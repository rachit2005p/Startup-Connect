@extends('layouts.app')

@section('title', 'Categories | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="section-title mb-0">Manage Categories</h1>
        <a class="btn btn-success" href="{{ route('admin.categories.create') }}">Add Category</a>
    </div>
    <div class="card p-3">
        <table class="table align-middle">
            <thead><tr><th>Name</th><th>Events</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->events_count }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete this category and its events?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3">No categories added yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
