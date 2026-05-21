<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $query = Event::with('category')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('mode')) {
            $query->where('mode', $request->mode);
        }

        return view('events.index', [
            'events' => $query->paginate(9)->withQueryString(),
            'categories' => Category::orderBy('category_name')->get(),
        ]);
    }

    public function show(Event $event): View
    {
        $event->load('category');
        $isBookmarked = auth()->check() && auth()->user()->bookmarkedEvents()->where('event_id', $event->id)->exists();
        $isRegistered = auth()->check() && auth()->user()->registeredEvents()->where('event_id', $event->id)->exists();

        return view('events.show', compact('event', 'isBookmarked', 'isRegistered'));
    }

    public function create(): View
    {
        return view('admin.events.create', [
            'categories' => Category::orderBy('category_name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedEvent($request);
        $data['image'] = $this->uploadImage($request);

        Event::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Event added successfully.');
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', [
            'event' => $event,
            'categories' => Category::orderBy('category_name')->get(),
        ]);
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = $this->validatedEvent($request);

        if ($request->hasFile('image')) {
            $this->deleteImage($event->image);
            $data['image'] = $this->uploadImage($request);
        }

        $event->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->deleteImage($event->image);
        $event->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Event deleted successfully.');
    }

    private function validatedEvent(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'event_date' => ['required', 'date'],
            'event_time' => ['required'],
            'location' => ['required', 'string', 'max:255'],
            'mode' => ['required', 'in:online,offline'],
            'organizer' => ['required', 'string', 'max:255'],
            'registration_link' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);
    }

    private function uploadImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->extension();

        Storage::disk('public')->putFileAs('uploads', $file, $filename);

        return $filename;
    }

    private function deleteImage(?string $filename): void
    {
        if ($filename) {
            Storage::disk('public')->delete('uploads/' . $filename);
        }
    }
}
