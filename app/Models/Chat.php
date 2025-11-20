<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'receiver_id',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function sender()
    {
        // Try to find in Pengguna first, then fallback to User
        $pengguna = \App\Models\Pengguna::find($this->sender_id);
        if ($pengguna) {
            return $this->belongsTo(\App\Models\Pengguna::class, 'sender_id');
        }
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        // Try to find in Pengguna first, then fallback to User
        $pengguna = \App\Models\Pengguna::find($this->receiver_id);
        if ($pengguna) {
            return $this->belongsTo(\App\Models\Pengguna::class, 'receiver_id');
        }
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get the conversation this message belongs to
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    /**
     * Get sender user (works with both User and Pengguna)
     */
    public function getSenderUser()
    {
        $pengguna = \App\Models\Pengguna::find($this->sender_id);
        if ($pengguna) {
            return $pengguna;
        }
        return User::find($this->sender_id);
    }

    /**
     * Get receiver user (works with both User and Pengguna)
     */
    public function getReceiverUser()
    {
        $pengguna = \App\Models\Pengguna::find($this->receiver_id);
        if ($pengguna) {
            return $pengguna;
        }
        return User::find($this->receiver_id);
    }

    public function scopeBetweenUsers($query, $user1Id, $user2Id)
    {
        return $query->where(function ($q) use ($user1Id, $user2Id) {
            $q->where('sender_id', $user1Id)->where('receiver_id', $user2Id);
        })->orWhere(function ($q) use ($user1Id, $user2Id) {
            $q->where('sender_id', $user2Id)->where('receiver_id', $user1Id);
        });
    }

    /**
     * Search messages by content
     */
    public function scopeSearch($query, $searchTerm)
    {
        if (empty($searchTerm)) {
            return $query;
        }
        
        // Use fulltext search if available, otherwise use LIKE
        return $query->whereRaw('MATCH(message) AGAINST(? IN BOOLEAN MODE)', [$searchTerm . '*'])
            ->orWhere('message', 'LIKE', '%' . $searchTerm . '%');
    }
}
