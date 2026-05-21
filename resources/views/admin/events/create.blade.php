@extends('layouts.app')

@section('title', 'Add Event | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="card p-4">
        <h1 class="h3 mb-3">Add Event</h1>
        <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
            @include('admin.events.form', ['buttonText' => 'Save Event'])
        </form>
    </div>
</section>
@endsection
