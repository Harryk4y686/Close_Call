<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaRegistered extends Model
{
    use HasFactory;

    protected $table = 'pengguna_registered';

    protected $fillable = [
        'user_id',
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
     * Get the user that owns the registered profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the owner of this profile (either User or Pengguna).
     */
    public function owner()
    {
        if ($this->user_id) {
            return $this->user();
        }
        return $this->pengguna();
    }

    /**
     * Calculate and return the profile completion percentage
     */
    public function calculateCompletionPercentage()
    {
        // Get the owner (either User or Pengguna)
        $owner = $this->user_id ? $this->user : $this->pengguna;
        $totalPercentage = 0; // Start from 0%

        // Upload photo (20%)
        if ($this->profile_picture) {
            $totalPercentage += 20;
        }

        // Personal info (25%) - check both user and profile data
        if ($owner && $owner->first_name && $owner->last_name && $owner->email && $owner->phone_number && $this->date_of_birth && $this->gender) {
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
