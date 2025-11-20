<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Chat;

return new class extends Migration
{
    /**
     * Run the migrations - Populate conversations table from existing chats
     */
    public function up(): void
    {
        // Get all unique user pairs from existing chats
        $existingChats = DB::table('chats')
            ->select('sender_id', 'receiver_id')
            ->get();
        
        $userPairs = [];
        
        foreach ($existingChats as $chat) {
            // Normalize user pairs (smaller ID first)
            $smallerId = min($chat->sender_id, $chat->receiver_id);
            $largerId = max($chat->sender_id, $chat->receiver_id);
            $key = $smallerId . '_' . $largerId;
            
            if (!isset($userPairs[$key])) {
                $userPairs[$key] = [
                    'user1_id' => $smallerId,
                    'user2_id' => $largerId
                ];
            }
        }
        
        // Create conversations for each unique user pair
        foreach ($userPairs as $pair) {
            // Get the last message timestamp for this pair
            $lastMessage = DB::table('chats')
                ->where(function($query) use ($pair) {
                    $query->where('sender_id', $pair['user1_id'])
                          ->where('receiver_id', $pair['user2_id']);
                })
                ->orWhere(function($query) use ($pair) {
                    $query->where('sender_id', $pair['user2_id'])
                          ->where('receiver_id', $pair['user1_id']);
                })
                ->orderBy('created_at', 'desc')
                ->first();
            
            // Insert conversation
            $conversationId = DB::table('conversations')->insertGetId([
                'user1_id' => $pair['user1_id'],
                'user2_id' => $pair['user2_id'],
                'last_message_at' => $lastMessage ? $lastMessage->created_at : now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // Update all chats between these users with the conversation_id
            DB::table('chats')
                ->where(function($query) use ($pair) {
                    $query->where('sender_id', $pair['user1_id'])
                          ->where('receiver_id', $pair['user2_id']);
                })
                ->orWhere(function($query) use ($pair) {
                    $query->where('sender_id', $pair['user2_id'])
                          ->where('receiver_id', $pair['user1_id']);
                })
                ->update(['conversation_id' => $conversationId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Set all conversation_ids back to null
        DB::table('chats')->update(['conversation_id' => null]);
        
        // Delete all conversations
        DB::table('conversations')->truncate();
    }
};
