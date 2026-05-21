<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;

class EventRegistrationController extends Controller
{
    public function store(Event $event): RedirectResponse
    {
        auth()->user()->registeredEvents()->syncWithoutDetaching([$event->id]);

        return back()->with('success', 'You are registered for this event.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        auth()->user()->registeredEvents()->detach($event->id);

        return back()->with('success', 'Your event registration has been cancelled.');
    }
}
