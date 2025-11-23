<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCompany extends Model
{
    use HasFactory;

    protected $table = 'admin_companies';

    protected $fillable = [
        'company_name',
        'industry',
        'about',
        'company_size',
        'closecall_employees',
        'hq',
        'location',
        'profile_picture',
        'banner_image',
    ];

    protected $casts = [
        'closecall_employees' => 'integer',
    ];
}
