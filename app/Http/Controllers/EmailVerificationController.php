<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmailUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code1' => 'required|numeric',
            'code2' => 'required|numeric',
            'code3' => 'required|numeric',
            'code4' => 'required|numeric',
            'code5' => 'required|numeric',
        ]);

        // Combine the code inputs into a single verification code
        $verificationCode = $request->code1 . $request->code2 . $request->code3 . $request->code4 . $request->code5;
        
        // For demonstration purposes, we'll accept any 5-digit code
        // In a real application, you would:
        // 1. Generate and store a verification code when sending the email
        // 2. Compare the submitted code with the stored code
        // 3. Check if the code has expired
        
        if (strlen($verificationCode) === 5 && ctype_digit($verificationCode)) {
            $user = Auth::user();
            
            if ($user) {
                // Update the email_verified_at field to mark email as verified
                $user->email_verified_at = Carbon::now();
                $user->save();
                
                // Redirect to landingpage2 after successful verification
                return redirect()->route('landingpage2')->with('success', 'Email berhasil diverifikasi!');
            }
        }
        
        return redirect()->back()->with('error', 'Kode verifikasi tidak valid. Silakan coba lagi.');
    }

    public function manualVerify(Request $request)
    {
        $user = User::find($request->user()->id);


        if ($user) {
            Mail::to($user->email)->send(new VerifyEmailUser());


            // Update the email_verified_at field to mark email as verified
            $user->email_verified_at = Carbon::now();
            $user->save();

            // Redirect to landingpage2 after successful verification
            return redirect()->route('landingpage2')->with('success', 'Email berhasil diverifikasi!');
        }

        return redirect()->route('login')->with('error', 'Terjadi kesalahan. Silakan login kembali.');
    }
}
