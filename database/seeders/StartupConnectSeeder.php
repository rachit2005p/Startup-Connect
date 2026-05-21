<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class StartupConnectSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@startupconnect.test'],
            ['name' => 'StartupConnect Admin', 'password' => 'password']
        );

        $categories = collect([
            'Hackathon',
            'Startup Meetup',
            'Workshop',
            'Founder Talk',
            'Coding Contest',
            'Internship Fair',
            'Webinar',
            'Entrepreneurship Seminar',
        ])->map(fn ($name) => Category::firstOrCreate(['category_name' => $name]));

        Event::firstOrCreate(
            ['title' => 'Campus Startup Hackathon'],
            [
                'description' => 'A beginner-friendly hackathon where students build startup ideas and pitch working prototypes.',
                'category_id' => $categories->firstWhere('category_name', 'Hackathon')->id,
                'event_date' => now()->addDays(10)->toDateString(),
                'event_time' => '10:00',
                'location' => 'Innovation Lab, Main Campus',
                'mode' => 'offline',
                'organizer' => 'Startup Cell',
                'registration_link' => null,
                'image' => 'campus-startup-hackathon.png',
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Founder Talk: From Idea to MVP'],
            [
                'description' => 'Learn how founders validate ideas, create a minimum viable product, and find first users.',
                'category_id' => $categories->firstWhere('category_name', 'Founder Talk')->id,
                'event_date' => now()->addDays(15)->toDateString(),
                'event_time' => '16:00',
                'location' => 'Google Meet',
                'mode' => 'online',
                'organizer' => 'Young Founders Club',
                'registration_link' => null,
                'image' => 'founder-talk-mvp.png',
            ]
        );
    }
}
