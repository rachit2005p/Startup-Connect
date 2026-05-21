@extends('layouts.app')

@section('title', 'Edit Event | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="card p-4">
        <h1 class="h3 mb-3">Edit Event</h1>
        <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.events.form', ['buttonText' => 'Update Event'])
        </form>
    </div>
</section>
@endsection
