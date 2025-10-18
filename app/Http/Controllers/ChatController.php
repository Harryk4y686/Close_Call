<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get all unique user IDs that the current user has chatted with
        $chatUserIds = Chat::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->get()
            ->map(function($chat) use ($user) {
                return $chat->sender_id == $user->id ? $chat->receiver_id : $chat->sender_id;
            })
            ->unique()
            ->values();

        // Get user details and last message info
        $chatPartners = collect();
        
        foreach ($chatUserIds as $partnerId) {
            $partner = User::find($partnerId);
            if ($partner) {
                // Get last message between users
                $lastMessage = Chat::betweenUsers($user->id, $partnerId)
                    ->orderBy('created_at', 'desc')
                    ->first();
                
                // Count unread messages
                $unreadCount = Chat::where('sender_id', $partnerId)
                    ->where('receiver_id', $user->id)
                    ->where('is_read', false)
                    ->count();
                
                $partner->last_message_time = $lastMessage ? $lastMessage->created_at : null;
                $partner->unread_count = $unreadCount;
                
                $chatPartners->push($partner);
            }
        }
        
        // Sort by last message time
        $chatPartners = $chatPartners->sortByDesc('last_message_time');

        return view('chat.index', compact('chatPartners'));
    }

    public function show($userId)
    {
        $user = Auth::user();
        $chatPartner = User::findOrFail($userId);
        
        // Get messages between current user and chat partner
        $messages = Chat::betweenUsers($user->id, $userId)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Mark messages as read
        Chat::where('sender_id', $userId)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        return view('chat.show', compact('messages', 'chatPartner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000'
        ]);

        $chat = Chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $chat->load(['sender', 'receiver'])
            ]);
        }

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function getMessages($userId)
    {
        $user = Auth::user();
        
        $messages = Chat::betweenUsers($user->id, $userId)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Mark messages as read
        Chat::where('sender_id', $userId)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        return response()->json($messages);
    }

    public function getUsersList()
    {
        $currentUser = Auth::user();
        
        // Get all users except current user
        $users = User::where('id', '!=', $currentUser->id)
            ->select('id', 'name', 'email', 'profile_photo')
            ->get();
        
        return response()->json($users);
    }
}
