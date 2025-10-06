<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return view('auth.verification-failed', [
                'message' => 'No verification token provided.'
            ]);
        }

        // Find the verification record
        $verification = EmailVerification::where('token', $token)->first();

        if (!$verification) {
            return view('auth.verification-failed', [
                'message' => 'Invalid verification token.'
            ]);
        }

        // Check if token is expired
        if ($verification->isExpired()) {
            // Delete expired token
            $verification->delete();
            return view('auth.verification-failed', [
                'message' => 'Verification link has expired. Please request a new one.'
            ]);
        }

        // Get the user
        $user = $verification->user;

        if ($user->verified) {
            // Delete the token since user is already verified
            $verification->delete();
            return redirect('http://127.0.0.1:8000/login')->with('info', 'Email is already verified! You can log in to your account.');
        }

        // Mark user as verified
        $user->update(['verified' => true]);

        // Delete the verification token
        $verification->delete();

        // Show email confirmed page
        return view('auth.email-confirmed');
    }
}
