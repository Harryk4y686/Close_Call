<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Test route to check admin user
Route::get('/test-admin', function () {
    $user = User::where('email', 'admin@gmail.com')->first();
    
    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'User not found in database'
        ]);
    }
    
    return response()->json([
        'status' => 'success',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'is_admin' => $user->is_admin,
            'has_password' => !empty($user->password),
            'password_length' => strlen($user->password),
        ],
        'test_password' => Hash::check('Admin123!', $user->password) ? 'Password matches!' : 'Password does NOT match',
    ]);
});

// Test login
Route::post('/test-login', function (\Illuminate\Http\Request $request) {
    $credentials = [
        'email' => 'admin@gmail.com',
        'password' => 'Admin123!'
    ];
    
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful!',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
            ]
        ]);
    }
    
    return response()->json([
        'status' => 'error',
        'message' => 'Authentication failed'
    ]);
});
