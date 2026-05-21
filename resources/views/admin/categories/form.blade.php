@csrf
<div class="mb-3">
    <label class="form-label">Category Name</label>
    <input class="form-control" type="text" name="category_name" value="{{ old('category_name', $category->category_name ?? '') }}">
</div>
<button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
<a class="btn btn-outline-secondary" href="{{ route('admin.categories.index') }}">Cancel</a>
