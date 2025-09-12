<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return redirect()->route('landingpage2')
                ->with('success', 'Login berhasil! Selamat datang ' . $user->fisrt_name);
        }

        // kalau gagal → balik ke login dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah!',
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