<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminJob extends Model
{
    use HasFactory;

    protected $table = 'admin_jobs';

    protected $fillable = [
        'job_name',
        'category',
        'company',
        'location',
        'description',
        'tag_1',
        'tag_2',
        'tag_3',
        'tag_4',
        'profile_picture',
        'banner_image',
    ];
}
