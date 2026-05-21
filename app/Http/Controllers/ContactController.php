<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        $adminEmail = config('mail.admin.address', config('mail.from.address', 'admin@startupconnect.test'));

        Mail::raw(
            "New contact message from {$validated['name']} ({$validated['email']}):\n\n{$validated['message']}",
            function ($message) use ($validated, $adminEmail) {
                $message->to($adminEmail)
                        ->subject('New StartupConnect Contact Feedback')
                        ->replyTo($validated['email'], $validated['name']);
            }
        );

        return back()->with('success', 'Thanks for contacting StartupConnect. We will reply soon.');
    }
}
