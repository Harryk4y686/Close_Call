<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Pengguna;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // bikin file login.blade.php
    }

    public function processLogin(Request $request)
    {
        // validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // attempt login with Laravel's authentication
        $credentials = $request->only('email', 'password');
        
        // Debug: Log the attempt
        Log::info('Login attempt', [
            'email' => $credentials['email'],
            'password_length' => strlen($credentials['password'])
        ]);
        
        // Check if user exists
        $user = \App\Models\User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            Log::warning('User not found: ' . $credentials['email']);
            return back()->withErrors([
                'email' => 'Email tidak ditemukan di sistem!',
            ])->withInput();
        }
        
        Log::info('User found', [
            'id' => $user->id,
            'email' => $user->email,
            'is_admin' => $user->is_admin ?? false,
            'has_password' => !empty($user->password)
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            Log::info('Login successful', ['user_id' => $user->id]);

            // Redirect admins to admin dashboard (no verification required for admins)
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, Admin ' . ($user->first_name ?? $user->name) . '!');
            }

            // Check if email is verified for regular users
            if (isset($user->verified) && !$user->verified) {
                Auth::logout(); // Log out the user
                return redirect()->route('login')
                    ->with('warning', 'Please verify your email address before logging in. Check your inbox for the verification link.')
                    ->with('show_resend_link', true)
                    ->with('user_email', $user->email);
            }

            // Regular users go to jobs page
            return redirect()->route('jobs')
                ->with('success', 'Login berhasil! Selamat datang ' . ($user->first_name ?? $user->name));
        }

        // kalau gagal → balik ke login dengan error
        Log::warning('Authentication failed for: ' . $credentials['email']);
        
        return back()->withErrors([
            'email' => 'Email atau password salah! Coba lagi.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}