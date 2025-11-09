<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Models\User;

Route::get('/debug-users', function () {
    $users = User::all();
    
    $output = '<h2>User Debug Information</h2>';
    $output .= '<style>table { border-collapse: collapse; width: 100%; } th, td { border: 1px solid #ddd; padding: 8px; text-align: left; } th { background-color: #f2f2f2; }</style>';
    $output .= '<table>';
    $output .= '<tr><th>ID</th><th>Name</th><th>First Name</th><th>Last Name</th><th>Full Name</th><th>Display Name</th><th>Email</th></tr>';
    
    foreach ($users as $user) {
        $output .= '<tr>';
        $output .= '<td>' . $user->id . '</td>';
        $output .= '<td>' . ($user->name ?? 'NULL') . '</td>';
        $output .= '<td>' . ($user->first_name ?? 'NULL') . '</td>';
        $output .= '<td>' . ($user->last_name ?? 'NULL') . '</td>';
        $output .= '<td>' . ($user->full_name ?? 'NULL') . '</td>';
        $output .= '<td>' . ($user->display_name ?? 'NULL') . '</td>';
        $output .= '<td>' . $user->email . '</td>';
        $output .= '</tr>';
    }
    
    $output .= '</table>';
    
    return $output;
});

Route::get('/fix-user-names', function () {
    $users = User::all();
    $fixed = 0;
    
    foreach ($users as $user) {
        // If user has no first_name/last_name but has a name, try to split it
        if (empty($user->first_name) && empty($user->last_name) && !empty($user->name)) {
            $nameParts = explode(' ', trim($user->name), 2);
            if (count($nameParts) >= 2) {
                $user->first_name = $nameParts[0];
                $user->last_name = $nameParts[1];
                $user->save();
                $fixed++;
            } elseif (count($nameParts) == 1 && $nameParts[0] !== 'Test User' && $nameParts[0] !== 'Default User') {
                $user->first_name = $nameParts[0];
                $user->save();
                $fixed++;
            }
        }
    }
    
    return "Fixed $fixed users. <a href='/debug-users'>Check users</a>";
});

Route::get('/debug-events', function () {
    $events = Event::with('creator')->get(['id', 'title', 'banner_image', 'user_id']);
    
    $output = '<h2>Event Debug Information</h2>';
    $output .= '<style>table { border-collapse: collapse; width: 100%; } th, td { border: 1px solid #ddd; padding: 8px; text-align: left; } th { background-color: #f2f2f2; } .exists-yes { color: green; font-weight: bold; } .exists-no { color: red; font-weight: bold; }</style>';
    $output .= '<table>';
    $output .= '<tr><th>ID</th><th>Title</th><th>Creator</th><th>Banner Path (DB)</th><th>File Exists</th><th>Preview</th></tr>';
    
    foreach ($events as $event) {
        $bannerExists = $event->banner_image ? file_exists(storage_path('app/public/' . $event->banner_image)) : false;
        $creatorName = $event->creator ? (($event->creator->first_name ?? '') . ' ' . ($event->creator->last_name ?? '')) : 'No Creator';
        $creatorName = trim($creatorName) ?: ($event->creator->name ?? 'No Name');
        
        $output .= '<tr>';
        $output .= '<td>' . $event->id . '</td>';
        $output .= '<td>' . htmlspecialchars($event->title) . '</td>';
        $output .= '<td>' . htmlspecialchars($creatorName) . '</td>';
        $output .= '<td>' . ($event->banner_image ?? '<em>NULL</em>') . '</td>';
        $output .= '<td class="' . ($bannerExists ? 'exists-yes' : 'exists-no') . '">' . ($bannerExists ? 'YES ✓' : 'NO ✗') . '</td>';
        $output .= '<td>';
        if ($event->banner_image && $bannerExists) {
            $output .= '<img src="' . asset('storage/' . $event->banner_image) . '" style="max-width: 100px; max-height: 60px; object-fit: cover;">';
        } else {
            $output .= '<em>No image</em>';
        }
        $output .= '</td>';
        $output .= '</tr>';
    }
    
    $output .= '</table>';
    
    // Also show storage directory contents
    $output .= '<h3>Storage Directory Contents:</h3>';
    $eventBannersPath = storage_path('app/public/event-banners');
    if (is_dir($eventBannersPath)) {
        $files = scandir($eventBannersPath);
        $files = array_filter($files, function($file) { return $file !== '.' && $file !== '..'; });
        
        if (empty($files)) {
            $output .= '<p>No files in event-banners directory</p>';
        } else {
            $output .= '<ul>';
            foreach ($files as $file) {
                $output .= '<li>' . $file . '</li>';
            }
            $output .= '</ul>';
        }
    } else {
        $output .= '<p>Event-banners directory does not exist</p>';
    }
    
    return $output;
});
