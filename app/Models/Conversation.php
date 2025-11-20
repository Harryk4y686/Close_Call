<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user1_id',
        'user2_id',
        'last_message_at'
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the first user in the conversation
     */
    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    /**
     * Get the second user in the conversation
     */
    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    /**
     * Get all messages in this conversation
     */
    public function messages()
    {
        return $this->hasMany(Chat::class, 'conversation_id');
    }

    /**
     * Scope to get conversations for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user1_id', $userId)
            ->orWhere('user2_id', $userId);
    }

    /**
     * Get the other user in the conversation (not the current user)
     */
    public function getOtherUser($currentUserId)
    {
        if ($this->user1_id == $currentUserId) {
            return $this->user2;
        }
        return $this->user1;
    }

    /**
     * Get unread message count for a specific user
     */
    public function getUnreadCount($userId)
    {
        return $this->messages()
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->count();
    }

    /**
     * Get the last message in this conversation
     */
    public function getLastMessage()
    {
        return $this->messages()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * Get time-based group (Today, Yesterday, or Previous)
     */
    public function getTimeGroup()
    {
        if (!$this->last_message_at) {
            return 'previous';
        }

        $messageDate = Carbon::parse($this->last_message_at);
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        if ($messageDate->isSameDay($today)) {
            return 'today';
        } elseif ($messageDate->isSameDay($yesterday)) {
            return 'yesterday';
        } else {
            return 'previous';
        }
    }

    /**
     * Update the last_message_at timestamp
     */
    public function updateLastMessageTime()
    {
        $this->last_message_at = now();
        $this->save();
    }

    /**
     * Find or create a conversation between two users
     */
    public static function findOrCreateBetweenUsers($user1Id, $user2Id)
    {
        // Ensure user1_id is always the smaller ID for consistency
        $smallerId = min($user1Id, $user2Id);
        $largerId = max($user1Id, $user2Id);

        return static::firstOrCreate(
            [
                'user1_id' => $smallerId,
                'user2_id' => $largerId
            ],
            [
                'last_message_at' => now()
            ]
        );
    }
}
