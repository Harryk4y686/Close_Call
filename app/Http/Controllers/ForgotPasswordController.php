<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Pengguna;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /**
     * Show the forgot password form
     */
    public function showForgotForm()
    {
        return view('forgot-password');
    }

    /**
     * Send password reset link to user's email
     */
    public function sendResetLink(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        // Check if email is Gmail
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', $email)) {
            return back()->withErrors([
                'email' => 'Password reset is only available for Gmail addresses (@gmail.com).'
            ])->withInput();
        }

        // Check if user exists in either User or Pengguna table
        $user = User::where('email', $email)->first();
        $pengguna = Pengguna::where('email', $email)->first();

        if (!$user && !$pengguna) {
            return back()->withErrors([
                'email' => 'We could not find a user with that email address.'
            ])->withInput();
        }

        // Delete any existing tokens for this email
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Generate a unique token
        $token = Str::random(64);

        // Store the token in the database
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now()
        ]);

        // Get user's name
        $userName = '';
        if ($user) {
            $userName = $user->first_name ?? $user->name ?? 'User';
        } elseif ($pengguna) {
            $userName = $pengguna->first_name ?? 'User';
        }

        // Send password reset email
        Mail::send('emails.password-reset-email', [
            'token' => $token,
            'email' => $email,
            'name' => $userName
        ], function($message) use ($email) {
            $message->to($email);
            $message->subject('CloseCall - Reset Your Password');
        });

        return back()->with('success', 'We have sent you a password reset link to your email address. Please check your inbox.');
    }

    /**
     * Show the reset password form
     */
    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    /**
     * Reset the user's password
     */
    public function resetPassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $email = $request->email;
        $token = $request->token;
        $password = $request->password;

        // Check if email is Gmail
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', $email)) {
            return back()->withErrors([
                'email' => 'Password reset is only available for Gmail addresses.'
            ])->withInput();
        }

        // Check if token exists and is valid
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors([
                'email' => 'Invalid or expired password reset token.'
            ])->withInput();
        }

        // Check if token matches
        if (!Hash::check($token, $resetRecord->token)) {
            return back()->withErrors([
                'email' => 'Invalid password reset token.'
            ])->withInput();
        }

        // Check if token is expired (60 minutes)
        $createdAt = Carbon::parse($resetRecord->created_at);
        if ($createdAt->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return back()->withErrors([
                'email' => 'This password reset link has expired. Please request a new one.'
            ])->withInput();
        }

        // Update password in User or Pengguna table
        $user = User::where('email', $email)->first();
        $pengguna = Pengguna::where('email', $email)->first();

        if ($user) {
            $user->password = Hash::make($password);
            $user->save();
        } elseif ($pengguna) {
            $pengguna->password = Hash::make($password);
            $pengguna->save();
        } else {
            return back()->withErrors([
                'email' => 'User not found.'
            ])->withInput();
        }

        // Delete the used token
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset successfully! You can now login with your new password.');
    }
}
