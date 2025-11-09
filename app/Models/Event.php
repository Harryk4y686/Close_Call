<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Pengguna;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'country',
        'banner_image',
        'attendees_count',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i',
    ];

    /**
     * Get the user that created the event.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the users attending this event.
     */
    public function attendees(): BelongsToMany
    {
        // Try to use Pengguna first, fallback to User
        $userModel = class_exists('App\Models\Pengguna') ? Pengguna::class : User::class;
        return $this->belongsToMany($userModel, 'event_attendees', 'event_id', 'user_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    /**
     * Check if a user is attending this event.
     */
    public function isAttendedBy($user): bool
    {
        return $this->attendees()->where('user_id', $user->id)->exists();
    }

    /**
     * Get the full URL for the banner image.
     */
    public function getBannerUrlAttribute(): string
    {
        if ($this->banner_image && \Storage::disk('public')->exists($this->banner_image)) {
            return asset('storage/' . $this->banner_image);
        }
        return asset('image/JCI.png'); // Default banner
    }

    /**
     * Check if event has a custom banner.
     */
    public function hasCustomBanner(): bool
    {
        return !empty($this->banner_image);
    }

    /**
     * Get formatted date and time.
     */
    public function getFormattedDateTimeAttribute(): string
    {
        return $this->event_date->format('D, d M Y') . ', ' . $this->event_time->format('g:i A');
    }

    /**
     * Scope to get only published events.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope to get upcoming events.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc')
            ->orderBy('event_time', 'asc');
    }

    /**
     * Scope to get past events.
     */
    public function scopePast($query)
    {
        return $query->where('event_date', '<', now()->toDateString())
            ->orderBy('event_date', 'desc');
    }
}

