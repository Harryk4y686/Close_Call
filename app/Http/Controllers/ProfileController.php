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
        // Admin users: use their own data directly, no profile
        if (Auth::guard('admin_user')->check()) {
            $user = Auth::guard('admin_user')->user();
            $profile = null;
        } else {
            $user = Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : Auth::guard('web')->user();
            $user->load('registeredProfile');
            $profile = $user->registeredProfile;
        }
        
        return view('profile', compact('user', 'profile'));
    }

    /**
     * Display the edit profile page
     */
    public function edit()
    {
        // Admin users: use their own data directly, no profile
        if (Auth::guard('admin_user')->check()) {
            $user = Auth::guard('admin_user')->user();
            $profile = null;
        } else {
            $user = Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : Auth::guard('web')->user();
            $user->load('registeredProfile');
            $profile = $user->registeredProfile;
        }
        
        return view('editProfile', compact('user', 'profile'));
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

        // Admin users: update admin_users table only, no profile
        if (Auth::guard('admin_user')->check()) {
            $user = Auth::guard('admin_user')->user();
            
            $updateData = [];
            $fields = ['first_name', 'last_name', 'email', 'phone_number', 'date_of_birth', 'gender', 'location', 'postal_code'];
            foreach ($fields as $field) {
                if ($request->filled($field)) {
                    $updateData[$field] = $request->input($field);
                }
            }
            
            // Handle file uploads for admin users
            if ($request->hasFile('profile_picture')) {
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                $updateData['profile_picture'] = $path;
            }
            if ($request->hasFile('banner_image')) {
                $path = $request->file('banner_image')->store('banner_images', 'public');
                $updateData['banner_image'] = $path;
            }
            if ($request->hasFile('resume')) {
                $path = $request->file('resume')->store('resumes', 'public');
                $updateData['resume'] = $path;
            }
            if ($request->hasFile('cv')) {
                $path = $request->file('cv')->store('cvs', 'public');
                $updateData['cv'] = $path;
            }
            if ($request->hasFile('portfolio')) {
                $path = $request->file('portfolio')->store('portfolios', 'public');
                $updateData['portfolio'] = $path;
            }
            
            $user->update($updateData);
            
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!',
                'user' => $user->fresh(),
                'profile' => null
            ]);
        }
        
        // Regular users: use pengguna + pengguna_registered
        $user = Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : Auth::guard('web')->user();
        
        // Update basic user information
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

        // Update profile data
        $profileUpdateData = [];
        $profileFields = ['date_of_birth', 'gender', 'location', 'postal_code'];
        foreach ($profileFields as $field) {
            if ($request->filled($field)) {
                $profileUpdateData[$field] = $request->input($field);
            }
        }



        if ($request->hasFile('banner_image')) {
            // Delete old banner image if exists
            if ($profile->banner_image && Storage::exists('public/' . $profile->banner_image)) {
                Storage::delete('public/' . $profile->banner_image);
            }
            
            $path = $request->file('banner_image')->store('banner_images', 'public');
            $profileUpdateData['banner_image'] = $path;
            
            // Sync to admin_users table if admin user
            if ($isAdminUser) {
                $user->update(['banner_image' => $path]);
            }
        }

        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            if ($profile->resume_path && Storage::exists('public/' . $profile->resume_path)) {
                Storage::delete('public/' . $profile->resume_path);
            }
            
            $path = $request->file('resume')->store('resumes', 'public');
            $profileUpdateData['resume_path'] = $path;
            
            // Sync to admin_users table if admin user
            if ($isAdminUser) {
                $user->update(['resume' => $path]);
            }
        }

        if ($request->hasFile('cv')) {
            // Delete old CV if exists
            if ($profile->cv_path && Storage::exists('public/' . $profile->cv_path)) {
                Storage::delete('public/' . $profile->cv_path);
            }
            
            $path = $request->file('cv')->store('cvs', 'public');
            $profileUpdateData['cv_path'] = $path;
            
            // Sync to admin_users table if admin user
            if ($isAdminUser) {
                $user->update(['cv' => $path]);
            }
        }

        if ($request->hasFile('portfolio')) {
            // Delete old portfolio if exists
            if ($profile->portfolio_path && Storage::exists('public/' . $profile->portfolio_path)) {
                Storage::delete('public/' . $profile->portfolio_path);
            }
            
            $path = $request->file('portfolio')->store('portfolios', 'public');
            $profileUpdateData['portfolio_path'] = $path;
            
            // Sync to admin_users table if admin user
            if ($isAdminUser) {
                $user->update(['portfolio' => $path]);
            }
        }

        // Update or create profile
        if (!empty($profileUpdateData)) {
            if ($profile->exists) {
                $profile->update($profileUpdateData);
            } else {
                // Add the correct foreign key based on user type
                if ($isAdminUser) {
                    $profileUpdateData['admin_user_id'] = $user->id;
                } else {
                    $profileUpdateData['pengguna_id'] = $user->id;
                }
                $profile = PenggunaRegistered::create($profileUpdateData);
            }
        } else if (!$profile->exists) {
            // Create empty profile if it doesn't exist
            if ($isAdminUser) {
                $profile = PenggunaRegistered::create(['admin_user_id' => $user->id]);
            } else {
                $profile = PenggunaRegistered::create(['pengguna_id' => $user->id]);
            }
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
        // Admin users: calculate from admin_users table
        if (Auth::guard('admin_user')->check()) {
            $user = Auth::guard('admin_user')->user();
            $fields = ['first_name', 'last_name', 'email', 'phone_number', 'date_of_birth', 'gender', 'location', 'postal_code', 'profile_picture', 'resume', 'cv', 'portfolio'];
            $filled = 0;
            foreach ($fields as $field) {
                if (!empty($user->$field)) $filled++;
            }
            $completionPercentage = round(($filled / count($fields)) * 100);
            return response()->json([
                'completion_percentage' => $completionPercentage,
                'has_profile' => true
            ]);
        }
        
        // Regular users: use pengguna_registered
        $user = Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : Auth::guard('web')->user();
        $profile = $user->registeredProfile;
        
        if ($profile) {
            $completionPercentage = $profile->completion_percentage;
        } else {
            $completionPercentage = 0;
        }

        return response()->json([
            'completion_percentage' => $completionPercentage,
            'has_profile' => $profile ? true : false
        ]);
    }
}
