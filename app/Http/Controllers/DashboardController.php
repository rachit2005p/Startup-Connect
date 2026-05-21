<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'bookmarkedEvents' => auth()->user()->bookmarkedEvents()->with('category')->latest('bookmarks.created_at')->get(),
            'registeredEvents' => auth()->user()->registeredEvents()->with('category')->latest('event_registrations.created_at')->get(),
            'hostedEvents' => auth()->user()->hostedEvents()->with('category')->latest()->get(),
        ]);
    }

    public function admin(): View
    {
        return view('admin.dashboard', [
            'events' => Event::with('category')->latest()->get(),
            'eventCount' => Event::count(),
            'categoryCount' => Category::count(),
        ]);
    }
}
