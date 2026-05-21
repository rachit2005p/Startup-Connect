<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HostEventController extends Controller
{
    public function create(): View
    {
        return view('events.host', [
            'categories' => Category::orderBy('category_name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedEvent($request);
        $data['hosted_by'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request);
        }

        Event::create($data);

        return redirect()->route('dashboard')->with('success', 'Your event has been listed successfully.');
    }

    public function edit(Event $event): View
    {
        $this->authorizeHostedEvent($event);

        return view('events.host', [
            'event' => $event,
            'categories' => Category::orderBy('category_name')->get(),
        ]);
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $this->authorizeHostedEvent($event);

        $data = $this->validatedEvent($request);

        if ($request->hasFile('image')) {
            $this->deleteImage($event->image);
            $data['image'] = $this->uploadImage($request);
        }

        $event->update($data);

        return redirect()->route('dashboard')->with('success', 'Your hosted event has been updated.');
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

    private function uploadImage(Request $request): string
    {
        File::ensureDirectoryExists(public_path('uploads'));

        $file = $request->file('image');
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        return $filename;
    }

    private function deleteImage(?string $filename): void
    {
        if ($filename && File::exists(public_path('uploads/' . $filename))) {
            File::delete(public_path('uploads/' . $filename));
        }
    }

    private function authorizeHostedEvent(Event $event): void
    {
        abort_unless($event->hosted_by === auth()->id() || auth()->user()->isAdmin(), 403);
    }
}
