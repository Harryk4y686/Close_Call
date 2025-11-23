<?php
// Sync Admin Users to Pengguna Registered
// Run this once: php artisan tinker < sync_admin_users.php

use App\Models\AdminUser;
use App\Models\PenggunaRegistered;

$adminUsers = AdminUser::all();
$synced = 0;

foreach ($adminUsers as $user) {
    $profile = $user->registeredProfile;
    
    $data = [
        'gender' => $user->gender,
        'date_of_birth' => $user->date_of_birth,
        'location' => $user->location,
        'postal_code' => $user->postal_code,
        'profile_picture' => $user->profile_picture,
        'banner_image' => $user->banner_image,
        'resume_path' => $user->resume,
        'cv_path' => $user->cv,
        'portfolio_path' => $user->portfolio,
    ];
    
    if (!$profile) {
        // Create new profile
        $data['admin_user_id'] = $user->id;
        PenggunaRegistered::create($data);
        echo "Created profile for user ID {$user->id}\n";
    } else {
        // Update existing profile
        $profile->update($data);
        echo "Updated profile for user ID {$user->id}\n";
    }
    
    $synced++;
}

echo "\nSynced {$synced} admin users to pengguna_registered table\n";
