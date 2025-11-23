<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminEvent extends Model
{
    use HasFactory;

    protected $table = 'admin_events';

    protected $fillable = [
        'event_name',
        'location',
        'attendees',
        'about',
        'starting_date',
        'banner_image',
    ];

    protected $casts = [
        'starting_date' => 'date',
        'attendees' => 'integer',
    ];
}
