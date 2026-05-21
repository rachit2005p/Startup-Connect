@csrf
<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Title</label>
        <input class="form-control" type="text" name="title" value="{{ old('title', $event->title ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Category</label>
        <select class="form-select" name="category_id">
            <option value="">Choose category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $event->category_id ?? '') == $category->id)>{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="4">{{ old('description', $event->description ?? '') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Event Date</label>
        <input class="form-control" type="date" name="event_date" value="{{ old('event_date', isset($event) ? $event->event_date->format('Y-m-d') : '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Event Time</label>
        <input class="form-control" type="time" name="event_time" value="{{ old('event_time', isset($event) ? \Illuminate\Support\Str::limit($event->event_time, 5, '') : '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Mode</label>
        <select class="form-select" name="mode">
            <option value="">Choose mode</option>
            <option value="online" @selected(old('mode', $event->mode ?? '') === 'online')>Online</option>
            <option value="offline" @selected(old('mode', $event->mode ?? '') === 'offline')>Offline</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Location</label>
        <input class="form-control" type="text" name="location" value="{{ old('location', $event->location ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Organizer</label>
        <input class="form-control" type="text" name="organizer" value="{{ old('organizer', $event->organizer ?? '') }}">
    </div>
    <div class="col-md-8">
        <label class="form-label">Registration Link</label>
        <input class="form-control" type="url" name="registration_link" value="{{ old('registration_link', $event->registration_link ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Event Image</label>
        <input class="form-control" type="file" name="image" accept="image/png,image/jpeg,image/webp">
        <div class="form-text">JPG, PNG, or WEBP up to 5 MB.</div>
    </div>
</div>
<button class="btn btn-primary mt-4" type="submit">{{ $buttonText }}</button>
<a class="btn btn-outline-secondary mt-4" href="{{ route('admin.dashboard') }}">Cancel</a>
