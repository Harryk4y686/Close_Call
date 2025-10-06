<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmailMail;
use App\Models\EmailVerification;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna',
            'phone_number' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user with verified = false
        $user = Pengguna::create([
            'first_name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'verified' => false,
        ]);

        // Generate unique verification token
        $token = Str::random(64);

        // Store verification token
        EmailVerification::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => Carbon::now()->addHours(24), // Token expires in 24 hours
        ]);

        // Send verification email
        Mail::to($user->email)->send(new VerifyEmailMail($user, $token));

        return redirect('http://127.0.0.1:8000/login')->with('success', 'Registration successful! Please check your email to verify your account before logging in.');
    }

    public function showVerificationNotice()
    {
        return view('auth.verify-email');
    }

    public function resendVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:pengguna,email'
        ]);

        $user = Pengguna::where('email', $request->email)->first();

        if ($user->verified) {
            return back()->with('error', 'Email is already verified.');
        }

        // Delete old tokens
        EmailVerification::where('user_id', $user->id)->delete();

        // Generate new token
        $token = Str::random(64);

        EmailVerification::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => Carbon::now()->addHours(24),
        ]);

        // Send verification email
        Mail::to($user->email)->send(new VerifyEmailMail($user, $token));

        return back()->with('success', 'Verification email has been resent!');
    }
}
