<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'featuredEvents' => Event::with('category')->latest()->take(3)->get(),
            'categories' => Category::withCount('events')->take(6)->get(),
        ]);
    }
}
