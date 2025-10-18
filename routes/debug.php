<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Debug route to check profile picture data
Route::get('/debug-profile-picture', function () {
    if (!Auth::check()) {
        return response()->json(['error' => 'Not authenticated']);
    }
    
    $user = Auth::user();
    $profile = $user->registeredProfile;
    
    return response()->json([
        'user_id' => $user->id,
        'user_name' => $user->first_name . ' ' . $user->last_name,
        'has_profile' => $profile ? true : false,
        'profile_picture_path' => $profile ? $profile->profile_picture : null,
        'full_url' => $profile && $profile->profile_picture ? asset('storage/' . $profile->profile_picture) : null,
        'file_exists' => $profile && $profile->profile_picture ? file_exists(storage_path('app/public/' . $profile->profile_picture)) : false,
        'storage_path' => $profile && $profile->profile_picture ? storage_path('app/public/' . $profile->profile_picture) : null,
    ]);
})->middleware('auth');
