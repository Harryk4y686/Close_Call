<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\PenggunaRegistered;
use Illuminate\Http\Request;

class TestRelationController extends Controller
{
    /**
     * Test the relationship between Pengguna and PenggunaRegistered
     */
    public function testRelations()
    {
        // Example 1: Get user with their registered profile
        $userWithProfile = Pengguna::with('registeredProfile')->first();
        
        if ($userWithProfile) {
            echo "<h3>User: " . $userWithProfile->first_name . " " . $userWithProfile->last_name . "</h3>";
            
            if ($userWithProfile->registeredProfile) {
                echo "<p>Profile Picture: " . ($userWithProfile->registeredProfile->profile_picture ?? 'Not set') . "</p>";
                echo "<p>Location: " . ($userWithProfile->registeredProfile->location ?? 'Not set') . "</p>";
                echo "<p>Gender: " . ($userWithProfile->registeredProfile->gender ?? 'Not set') . "</p>";
            } else {
                echo "<p>No registered profile found</p>";
            }
        }
        
        echo "<hr>";
        
        // Example 2: Get profile with user information
        $profileWithUser = PenggunaRegistered::with('pengguna')->first();
        
        if ($profileWithUser) {
            echo "<h3>Profile belongs to: " . $profileWithUser->pengguna->first_name . " " . $profileWithUser->pengguna->last_name . "</h3>";
            echo "<p>Email: " . $profileWithUser->pengguna->email . "</p>";
            echo "<p>Phone: " . $profileWithUser->pengguna->phone_number . "</p>";
        } else {
            echo "<p>No registered profiles found</p>";
        }
        
        echo "<hr>";
        
        // Example 3: Create a new profile for a user
        $user = Pengguna::first();
        if ($user && !$user->registeredProfile) {
            $newProfile = PenggunaRegistered::create([
                'pengguna_id' => $user->id,
                'location' => 'Jakarta',
                'gender' => 'male',
                'date_of_birth' => '1990-01-01'
            ]);
            
            echo "<p>Created new profile for user: " . $user->first_name . "</p>";
        }
        
        return response()->json([
            'message' => 'Relationship test completed. Check the output above.',
            'relationships' => [
                'Pengguna -> PenggunaRegistered' => 'hasOne (registeredProfile)',
                'PenggunaRegistered -> Pengguna' => 'belongsTo (pengguna)'
            ]
        ]);
    }
    
    /**
     * Show all users with their profiles
     */
    public function showAllUsersWithProfiles()
    {
        $users = Pengguna::with('registeredProfile')->get();
        
        $result = [];
        foreach ($users as $user) {
            $result[] = [
                'user_id' => $user->id,
                'name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'has_profile' => $user->registeredProfile ? true : false,
                'profile_data' => $user->registeredProfile ? [
                    'profile_picture' => $user->registeredProfile->profile_picture,
                    'location' => $user->registeredProfile->location,
                    'gender' => $user->registeredProfile->gender,
                    'date_of_birth' => $user->registeredProfile->date_of_birth,
                ] : null
            ];
        }
        
        return response()->json([
            'users_with_profiles' => $result
        ]);
    }
    
    /**
     * Test progress calculation and saving
     */
    public function testProgressSaving()
    {
        $user = Pengguna::first();
        
        if (!$user) {
            return response()->json(['error' => 'No users found']);
        }
        
        // Get or create profile
        $profile = $user->registeredProfile;
        if (!$profile) {
            $profile = PenggunaRegistered::create([
                'pengguna_id' => $user->id,
                'location' => 'Test Location',
                'postal_code' => '12345'
            ]);
        }
        
        // Calculate and save progress
        $calculatedProgress = $profile->calculateCompletionPercentage();
        $savedProgress = $profile->updateCompletionPercentage();
        
        return response()->json([
            'user' => $user->first_name . ' ' . $user->last_name,
            'calculated_progress' => $calculatedProgress,
            'saved_progress' => $savedProgress,
            'profile_data' => [
                'has_photo' => $profile->profile_picture ? true : false,
                'has_personal_info' => ($user->first_name && $user->last_name && $user->email && $user->phone_number && $profile->date_of_birth && $profile->gender) ? true : false,
                'has_location' => ($profile->location && $profile->postal_code) ? true : false,
                'has_resume_cv' => ($profile->resume_path && $profile->cv_path) ? true : false,
                'has_portfolio' => $profile->portfolio_path ? true : false,
            ],
            'completion_breakdown' => [
                'photo' => $profile->profile_picture ? 20 : 0,
                'personal_info' => ($user->first_name && $user->last_name && $user->email && $user->phone_number && $profile->date_of_birth && $profile->gender) ? 25 : 0,
                'location' => ($profile->location && $profile->postal_code) ? 20 : 0,
                'resume_cv' => ($profile->resume_path && $profile->cv_path) ? 20 : 0,
                'portfolio' => $profile->portfolio_path ? 15 : 0,
            ]
        ]);
    }
}
