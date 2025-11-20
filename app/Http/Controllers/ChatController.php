<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Get authenticated user from either guard
     */
    protected function getAuthUser()
    {
        return Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : Auth::guard('web')->user();
    }

    public function index()
    {
        $user = $this->getAuthUser();
        
        // Get all conversations for the current user
        $conversations = Conversation::forUser($user->id)
            ->with(['user1', 'user2'])
            ->orderBy('last_message_at', 'desc')
            ->get();
        
        // Prepare conversation data with additional info
        $chatPartners = $conversations->map(function($conversation) use ($user) {
            $partner = $conversation->getOtherUser($user->id);
            $lastMessage = $conversation->getLastMessage();
            $unreadCount = $conversation->getUnreadCount($user->id);
            
            $partner->last_message = $lastMessage ? $lastMessage->message : null;
            $partner->last_message_time = $conversation->last_message_at;
            $partner->unread_count = $unreadCount;
            $partner->conversation_id = $conversation->id;
            
            return $partner;
        });

        return view('chat.index-chat', compact('chatPartners'));
    }

    public function show($userId)
    {
        $user = $this->getAuthUser();
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
        
        return view('chat.show-chat', compact('messages', 'chatPartner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000'
        ]);

        $user = $this->getAuthUser();
        
        // Find or create conversation
        $conversation = Conversation::findOrCreateBetweenUsers($user->id, $request->receiver_id);
        
        // Create the message
        $chat = Chat::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false
        ]);
        
        // Update conversation's last message time
        $conversation->updateLastMessageTime();

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
        $user = $this->getAuthUser();
        
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
        $currentUser = $this->getAuthUser();
        
        // Get all users except current user
        $users = User::where('id', '!=', $currentUser->id)
            ->select('id', 'name', 'email', 'profile_photo')
            ->get();
        
        return response()->json($users);
    }

    /**
     * Get conversations grouped by time (Today, Yesterday, Previous)
     */
    public function getConversations()
    {
        $user = $this->getAuthUser();
        
        $conversations = Conversation::forUser($user->id)
            ->with(['user1', 'user2'])
            ->orderBy('last_message_at', 'desc')
            ->get();
        
        // Group conversations by time
        $grouped = [
            'today' => [],
            'yesterday' => [],
            'previous' => []
        ];
        
        foreach ($conversations as $conversation) {
            $timeGroup = $conversation->getTimeGroup();
            $partner = $conversation->getOtherUser($user->id);
            $lastMessage = $conversation->getLastMessage();
            
            $grouped[$timeGroup][] = [
                'id' => $conversation->id,
                'partner' => [
                    'id' => $partner->id,
                    'name' => $partner->name,
                    'email' => $partner->email,
                    'profile_photo' => $partner->profile_photo ?? null
                ],
                'last_message' => $lastMessage ? [
                    'message' => $lastMessage->message,
                    'created_at' => $lastMessage->created_at,
                    'is_sender' => $lastMessage->sender_id == $user->id
                ] : null,
                'unread_count' => $conversation->getUnreadCount($user->id),
                'last_message_at' => $conversation->last_message_at
            ];
        }
        
        return response()->json($grouped);
    }

    /**
     * Create a new conversation with a user
     */
    public function createConversation(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
        
        $currentUser = $this->getAuthUser();
        
        // Check if conversation already exists
        $conversation = Conversation::findOrCreateBetweenUsers($currentUser->id, $request->user_id);
        
        return response()->json([
            'success' => true,
            'conversation' => [
                'id' => $conversation->id,
                'partner' => User::find($request->user_id),
                'created_at' => $conversation->created_at
            ]
        ]);
    }

    /**
     * Search conversations and messages
     */
    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:1'
        ]);
        
        $user = $this->getAuthUser();
        $searchTerm = $request->input('q');
        
        // Search in messages
        $messageResults = Chat::search($searchTerm)
            ->where(function($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->with(['sender', 'receiver', 'conversation'])
            ->limit(20)
            ->get();
        
        // Search in user names (find conversations with matching users)
        $userResults = User::where('id', '!=', $user->id)
            ->where(function($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            })
            ->limit(10)
            ->get();
        
        // Get conversations for matched users
        $conversationResults = [];
        foreach ($userResults as $foundUser) {
            $conversation = Conversation::where(function($query) use ($user, $foundUser) {
                $query->where('user1_id', $user->id)->where('user2_id', $foundUser->id);
            })->orWhere(function($query) use ($user, $foundUser) {
                $query->where('user1_id', $foundUser->id)->where('user2_id', $user->id);
            })->first();
            
            if ($conversation) {
                $conversationResults[] = [
                    'conversation_id' => $conversation->id,
                    'partner' => $foundUser,
                    'last_message' => $conversation->getLastMessage()
                ];
            }
        }
        
        return response()->json([
            'messages' => $messageResults,
            'conversations' => $conversationResults,
            'users' => $userResults
        ]);
    }
}
