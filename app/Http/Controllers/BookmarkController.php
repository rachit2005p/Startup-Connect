<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;

class BookmarkController extends Controller
{
    public function store(Event $event): RedirectResponse
    {
        auth()->user()->bookmarkedEvents()->syncWithoutDetaching([$event->id]);

        return back()->with('success', 'Event bookmarked.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        auth()->user()->bookmarkedEvents()->detach($event->id);

        return back()->with('success', 'Bookmark removed.');
    }
}
