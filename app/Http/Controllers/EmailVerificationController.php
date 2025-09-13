<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }

    public function manualVerify(Request $request)
    {
        $user = Auth::user();
        
        if ($user) {
            // Update the email_verified_at field to mark email as verified
            $user->email_verified_at = Carbon::now();
            $user->save();
            
            // Redirect to landingpage2 after successful verification
            return redirect()->route('landingpage2')->with('success', 'Email berhasil diverifikasi!');
        }
        
        return redirect()->route('login')->with('error', 'Terjadi kesalahan. Silakan login kembali.');
    }
}
