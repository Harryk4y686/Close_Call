<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaRegistered extends Model
{
    use HasFactory;

    protected $table = 'pengguna_registered';

    protected $fillable = [
        'pengguna_id',
        'profile_picture',
        'date_of_birth',
        'gender',
        'location',
        'postal_code',
        'resume_path',
        'cv_path',
        'portfolio_path',
        'banner_image',
        'completion_percentage',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Get the pengguna that owns the registered profile.
     */
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    /**
     * Calculate and return the profile completion percentage
     */
    public function calculateCompletionPercentage()
    {
        $user = $this->pengguna;
        $totalPercentage = 0; // Start from 0%

        // Upload photo (20%)
        if ($this->profile_picture) {
            $totalPercentage += 20;
        }

        // Personal info (25%) - check both user and profile data
        if ($user && $user->first_name && $user->last_name && $user->email && $user->phone_number && $this->date_of_birth && $this->gender) {
            $totalPercentage += 25;
        }

        // Location (20%)
        if ($this->location && $this->postal_code) {
            $totalPercentage += 20;
        }

        // Resume & CV (20%)
        if ($this->resume_path && $this->cv_path) {
            $totalPercentage += 20;
        }

        // Portfolio (15%)
        if ($this->portfolio_path) {
            $totalPercentage += 15;
        }

        return $totalPercentage;
    }

    /**
     * Update the completion percentage and save to database
     */
    public function updateCompletionPercentage()
    {
        $this->completion_percentage = $this->calculateCompletionPercentage();
        $this->save();
        return $this->completion_percentage;
    }
}
