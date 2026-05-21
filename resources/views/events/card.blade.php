<div class="col-md-6 col-lg-4">
    <div class="card h-100">
        @if($event->image)
            <img class="card-img-top event-image" src="{{ asset('uploads/' . $event->image) }}" alt="{{ $event->title }}">
        @else
            <div class="event-image bg-secondary-subtle d-flex align-items-center justify-content-center">
                <span class="text-secondary">Startup Event</span>
            </div>
        @endif
        <div class="card-body d-flex flex-column">
            <span class="badge bg-info text-dark align-self-start mb-2">{{ $event->category->category_name ?? 'General' }}</span>
            <h3 class="h5">{{ $event->title }}</h3>
            <p class="text-muted mb-1">{{ $event->event_date->format('d M Y') }} at {{ \Illuminate\Support\Str::limit($event->event_time, 5, '') }}</p>
            <p class="mb-3">Organizer: {{ $event->organizer }}</p>
            <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary mt-auto">View Details</a>
            @if(!empty($showHostActions))
                <a href="{{ route('host-events.edit', $event) }}" class="btn btn-outline-secondary mt-2">Edit Hosted Event</a>
            @endif
        </div>
    </div>
</div>
