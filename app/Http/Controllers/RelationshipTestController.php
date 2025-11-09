<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengguna;
use App\Models\Event;
use App\Models\Chat;
use App\Models\PenggunaRegistered;
use App\Models\EmailVerification;

class RelationshipTestController extends Controller
{
    public function testRelationships()
    {
        $results = [];
        
        try {
            // Test User relationships
            $results['users_count'] = User::count();
            $results['pengguna_count'] = Pengguna::count();
            $results['events_count'] = Event::count();
            $results['chats_count'] = Chat::count();
            $results['registered_profiles_count'] = PenggunaRegistered::count();
            $results['email_verifications_count'] = EmailVerification::count();
            
            // Test User -> Events relationship
            $user = User::first();
            if ($user) {
                $results['user_created_events'] = $user->createdEvents()->count();
                $results['user_attending_events'] = $user->attendingEvents()->count();
                $results['user_sent_chats'] = $user->sentChats()->count();
                $results['user_received_chats'] = $user->receivedChats()->count();
                $results['user_registered_profile'] = $user->registeredProfile ? 'exists' : 'none';
            }
            
            // Test Pengguna -> Events relationship
            $pengguna = Pengguna::first();
            if ($pengguna) {
                $results['pengguna_created_events'] = $pengguna->createdEvents()->count();
                $results['pengguna_attending_events'] = $pengguna->attendingEvents()->count();
                $results['pengguna_sent_chats'] = $pengguna->sentChats()->count();
                $results['pengguna_received_chats'] = $pengguna->receivedChats()->count();
                $results['pengguna_registered_profile'] = $pengguna->registeredProfile ? 'exists' : 'none';
            }
            
            // Test Event relationships
            $event = Event::first();
            if ($event) {
                $results['event_creator'] = $event->creator ? $event->creator->first_name : 'none';
                $results['event_attendees_count'] = $event->attendees()->count();
            }
            
            // Test PenggunaRegistered relationships
            $profile = PenggunaRegistered::first();
            if ($profile) {
                $results['profile_owner_type'] = $profile->user_id ? 'User' : ($profile->pengguna_id ? 'Pengguna' : 'none');
                $results['profile_completion'] = $profile->calculateCompletionPercentage() . '%';
            }
            
            $results['status'] = 'success';
            
        } catch (\Exception $e) {
            $results['status'] = 'error';
            $results['error'] = $e->getMessage();
        }
        
        return response()->json($results, 200, [], JSON_PRETTY_PRINT);
    }
    
    public function testChatRelationships()
    {
        $results = [];
        
        try {
            $chat = Chat::first();
            if ($chat) {
                $sender = $chat->getSenderUser();
                $receiver = $chat->getReceiverUser();
                
                $results['chat_sender'] = $sender ? $sender->first_name : 'none';
                $results['chat_receiver'] = $receiver ? $receiver->first_name : 'none';
                $results['chat_sender_type'] = $sender ? get_class($sender) : 'none';
                $results['chat_receiver_type'] = $receiver ? get_class($receiver) : 'none';
            }
            
            $results['status'] = 'success';
            
        } catch (\Exception $e) {
            $results['status'] = 'error';
            $results['error'] = $e->getMessage();
        }
        
        return response()->json($results, 200, [], JSON_PRETTY_PRINT);
    }
}
