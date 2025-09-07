<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';

    protected $fillable = [
        'fisrt_name',  // matches the actual column name in database
        'last_name',
        'email',
        'password',
        'country',
        'phone_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
