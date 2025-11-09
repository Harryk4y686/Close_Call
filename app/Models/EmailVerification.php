<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        // Try to find in Pengguna first, then fallback to User
        $pengguna = \App\Models\Pengguna::find($this->user_id);
        if ($pengguna) {
            return $this->belongsTo(Pengguna::class, 'user_id');
        }
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user (works with both User and Pengguna)
     */
    public function getUser()
    {
        $pengguna = \App\Models\Pengguna::find($this->user_id);
        if ($pengguna) {
            return $pengguna;
        }
        return \App\Models\User::find($this->user_id);
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
