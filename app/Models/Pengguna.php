<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'country',
        'phone_number',
        'verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'verified' => 'boolean',
    ];

    public function emailVerifications()
    {
        return $this->hasMany(EmailVerification::class, 'user_id');
    }

    /**
     * Get the registered profile for the pengguna.
     */
    public function registeredProfile()
    {
        return $this->hasOne(PenggunaRegistered::class, 'pengguna_id');
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
        return $this->belongsToMany(Event::class, 'event_attendees', 'user_id', 'event_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    /**
     * Get the full name attribute.
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
