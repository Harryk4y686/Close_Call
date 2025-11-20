<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    /**
     * Get the currently authenticated user from either guard
     */
    public static function user()
    {
        if (Auth::guard('pengguna')->check()) {
            return Auth::guard('pengguna')->user();
        }
        
        if (Auth::guard('web')->check()) {
            return Auth::guard('web')->user();
        }
        
        return null;
    }
}
