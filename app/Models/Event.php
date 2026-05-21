<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $fillable = [
        'title',
        'hosted_by',
        'description',
        'category_id',
        'event_date',
        'event_time',
        'location',
        'mode',
        'organizer',
        'registration_link',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'hosted_by');
    }

    public function bookmarkedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function registeredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_registrations')->withTimestamps();
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        $storedPath = 'uploads/' . $this->image;

        if (Storage::disk('public')->exists($storedPath)) {
            return Storage::url($storedPath);
        }

        return asset('uploads/' . $this->image);
    }
}
