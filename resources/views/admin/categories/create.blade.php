@extends('layouts.app')

@section('title', 'Add Category | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="card p-4">
        <h1 class="h3 mb-3">Add Category</h1>
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @include('admin.categories.form', ['buttonText' => 'Save Category'])
        </form>
    </div>
</section>
@endsection
