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
        
        // Check if user exists in AdminUser table
        $adminUser = \App\Models\AdminUser::where('email', $credentials['email'])->first();
        
        if ($adminUser) {
            Log::info('Admin user found, attempting password authentication', [
                'id' => $adminUser->id,
                'email' => $adminUser->email
            ]);
            
            // Attempt authentication with password
            if (Auth::guard('admin_user')->attempt($credentials)) {
                Auth::shouldUse('admin_user');
                
                Log::info('Admin user login successful', ['user_id' => $adminUser->id]);
                
                // Redirect to jobs page
                return redirect()->route('jobs')
                    ->with('success', 'Welcome ' . $adminUser->first_name . '!');
            }
            
            // Password incorrect for admin user
            Log::warning('Admin user password incorrect: ' . $credentials['email']);
            return back()->withErrors([
                'email' => 'Email atau password salah! Coba lagi.',
            ])->withInput();
        }
        
        // Check if user exists in User table first
        $user = \App\Models\User::where('email', $credentials['email'])->first();
        
        // If not in User table, check Pengguna table
        if (!$user) {
            $pengguna = \App\Models\Pengguna::where('email', $credentials['email'])->first();
            
            if (!$pengguna) {
                Log::warning('User not found in either table: ' . $credentials['email']);
                return back()->withErrors([
                    'email' => 'Email tidak ditemukan di sistem!',
                ])->withInput();
            }
            
            // Try to authenticate with Pengguna guard
            Log::info('Attempting Pengguna login', [
                'id' => $pengguna->id,
                'email' => $pengguna->email
            ]);
            
            if (Auth::guard('pengguna')->attempt($credentials)) {
                $authenticatedUser = Auth::guard('pengguna')->user();
                
                // Set the default guard to pengguna for this session
                Auth::shouldUse('pengguna');
                
                Log::info('Pengguna login successful', ['user_id' => $authenticatedUser->id]);
                
                // Check if email is verified
                if (isset($authenticatedUser->verified) && !$authenticatedUser->verified) {
                    Auth::guard('pengguna')->logout();
                    return redirect()->route('login')
                        ->with('warning', 'Please verify your email address before logging in.')
                        ->with('show_resend_link', true)
                        ->with('user_email', $authenticatedUser->email);
                }
                
                // Pengguna users go to jobs page
                return redirect()->route('jobs')
                    ->with('success', 'Login berhasil! Selamat datang ' . $pengguna->first_name);
            }
            
            Log::warning('Pengguna authentication failed for: ' . $credentials['email']);
            return back()->withErrors([
                'email' => 'Email atau password salah! Coba lagi.',
            ])->withInput();
        }
        
        // User found in User table
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
        // Logout from all guards to ensure complete logout
        Auth::guard('web')->logout();
        Auth::guard('pengguna')->logout();
        Auth::guard('admin_user')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}