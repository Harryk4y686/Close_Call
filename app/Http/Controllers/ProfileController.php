<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\PenggunaRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the profile page
     */
    public function index()
    {
        /** @var \App\Models\Pengguna $user */
        // Get user from either guard
        $user = Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : Auth::guard('web')->user();
        
        // Load the user with their registered profile using Eloquent relationship
        $user->load('registeredProfile');
        $profile = $user->registeredProfile;
        
        return view('profile', compact('user', 'profile'));
    }

    /**
     * Update the user's profile information
     */
    public function update(Request $request)
    {
        // Note: Email verification is handled by middleware
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'location' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'portfolio' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        /** @var \App\Models\Pengguna $user */
        // Get user from either guard
        $user = Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : Auth::guard('web')->user();
        
        // Update basic user information (pengguna table)
        $userUpdateData = [];
        $userFields = ['first_name', 'last_name', 'email', 'phone_number'];
        foreach ($userFields as $field) {
            if ($request->filled($field)) {
                $userUpdateData[$field] = $request->input($field);
            }
        }
        
        if (!empty($userUpdateData)) {
            $user->update($userUpdateData);
        }

        // Get or create registered profile
        $profile = $user->registeredProfile;
        if (!$profile) {
            $profile = new PenggunaRegistered(['pengguna_id' => $user->id]);
        }

        // Update profile data (pengguna_registered table)
        $profileUpdateData = [];
        $profileFields = ['date_of_birth', 'gender', 'location', 'postal_code'];
        foreach ($profileFields as $field) {
            if ($request->filled($field)) {
                $profileUpdateData[$field] = $request->input($field);
            }
        }

        // Handle file uploads
        if ($request->hasFile('profile_picture')) {
            Log::info('Profile picture upload detected', [
                'original_name' => $request->file('profile_picture')->getClientOriginalName(),
                'size' => $request->file('profile_picture')->getSize(),
                'mime_type' => $request->file('profile_picture')->getMimeType()
            ]);
            
            // Delete old profile picture if exists
            if ($profile->profile_picture && Storage::exists('public/' . $profile->profile_picture)) {
                Storage::delete('public/' . $profile->profile_picture);
                Log::info('Deleted old profile picture: ' . $profile->profile_picture);
            }
            
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $profileUpdateData['profile_picture'] = $path;
            
            Log::info('Profile picture saved to: ' . $path);
        }

        if ($request->hasFile('banner_image')) {
            // Delete old banner image if exists
            if ($profile->banner_image && Storage::exists('public/' . $profile->banner_image)) {
                Storage::delete('public/' . $profile->banner_image);
            }
            
            $path = $request->file('banner_image')->store('banner_images', 'public');
            $profileUpdateData['banner_image'] = $path;
        }

        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            if ($profile->resume_path && Storage::exists('public/' . $profile->resume_path)) {
                Storage::delete('public/' . $profile->resume_path);
            }
            
            $path = $request->file('resume')->store('resumes', 'public');
            $profileUpdateData['resume_path'] = $path;
        }

        if ($request->hasFile('cv')) {
            // Delete old CV if exists
            if ($profile->cv_path && Storage::exists('public/' . $profile->cv_path)) {
                Storage::delete('public/' . $profile->cv_path);
            }
            
            $path = $request->file('cv')->store('cvs', 'public');
            $profileUpdateData['cv_path'] = $path;
        }

        if ($request->hasFile('portfolio')) {
            // Delete old portfolio if exists
            if ($profile->portfolio_path && Storage::exists('public/' . $profile->portfolio_path)) {
                Storage::delete('public/' . $profile->portfolio_path);
            }
            
            $path = $request->file('portfolio')->store('portfolios', 'public');
            $profileUpdateData['portfolio_path'] = $path;
        }

        // Update or create profile
        if (!empty($profileUpdateData)) {
            if ($profile->exists) {
                $profile->update($profileUpdateData);
            } else {
                $profileUpdateData['pengguna_id'] = $user->id;
                $profile = PenggunaRegistered::create($profileUpdateData);
            }
        } else if (!$profile) {
            // Create empty profile if it doesn't exist
            $profile = PenggunaRegistered::create(['pengguna_id' => $user->id]);
        }

        // Calculate and save completion percentage
        $completionPercentage = $profile->updateCompletionPercentage();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'user' => $user->fresh(),
            'profile' => $profile->fresh(),
            'completion_percentage' => $completionPercentage
        ]);
    }

    /**
     * Get profile completion percentage from database
     */
    public function getCompletionPercentage()
    {
        /** @var \App\Models\Pengguna $user */
        // Get user from either guard
        $user = Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : Auth::guard('web')->user();
        $profile = $user->registeredProfile;
        
        if ($profile) {
            // Return saved percentage from database
            $completionPercentage = $profile->completion_percentage;
        } else {
            // If no profile exists, start from 0%
            $completionPercentage = 0;
        }

        return response()->json([
            'completion_percentage' => $completionPercentage,
            'has_profile' => $profile ? true : false
        ]);
    }
}
