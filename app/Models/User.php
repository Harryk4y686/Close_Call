<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'first_name',
        'email',
        'phone_number',
        'mobile_number',
        'country',
        'password',
        'verified',
        'is_admin',
        'date_of_birth',
        'gender',
        'location',
        'postal_code',
        'profile_photo',
        'banner_photo',
        'resume_file',
        'cv_file',
        'portfolio_file',
        'profile_completion_percentage',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'verified' => 'boolean',
    ];

    public function emailVerifications()
    {
        return $this->hasMany(EmailVerification::class);
    }

    public function sentChats()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function receivedChats()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

    public function registeredProfile()
    {
        return $this->hasOne(PenggunaRegistered::class, 'user_id');
    }

    /**
     * Get events created by the user.
     */
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    /**
     * Get events the user is attending.
     */
    public function attendingEvents()
    {
        return $this->belongsToMany(Event::class, 'event_attendees')
            ->withPivot('status')
            ->withTimestamps();
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        // First try first_name + last_name
        if (!empty($this->first_name) && !empty($this->last_name)) {
            return trim($this->first_name . ' ' . $this->last_name);
        }
        
        // Then try just first_name
        if (!empty($this->first_name)) {
            return $this->first_name;
        }
        
        // Then try the name field
        if (!empty($this->name) && $this->name !== 'Test User') {
            return $this->name;
        }
        
        // Default fallback
        return 'User';
    }

    /**
     * Get the user's display name (prioritize full name).
     */
    public function getDisplayNameAttribute()
    {
        return $this->getFullNameAttribute();
    }

    /**
     * Get the user's proper name for events.
     */
    public function getEventCreatorNameAttribute()
    {
        // For events, we want to show the most complete name possible
        if (!empty($this->first_name) && !empty($this->last_name)) {
            return trim($this->first_name . ' ' . $this->last_name);
        }
        
        if (!empty($this->first_name)) {
            return $this->first_name;
        }
        
        if (!empty($this->name) && $this->name !== 'Test User' && $this->name !== 'Default User') {
            return $this->name;
        }
        
        return 'Event Creator';
    }
}
