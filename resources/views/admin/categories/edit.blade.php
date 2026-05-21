@extends('layouts.app')

@section('title', 'Edit Category | StartupConnect')

@section('content')
<section class="container my-5">
    <div class="card p-4">
        <h1 class="h3 mb-3">Edit Category</h1>
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @method('PUT')
            @include('admin.categories.form', ['buttonText' => 'Update Category'])
        </form>
    </div>
</section>
@endsection
