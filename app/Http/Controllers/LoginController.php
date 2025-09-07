<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        // cari user berdasarkan email di tabel pengguna
        $pengguna = Pengguna::where('email', $request->email)->first();

        // cek apakah user ada dan password cocok
        if ($pengguna && Hash::check($request->password, $pengguna->password)) {
            // simpan data user ke session
            session([
                'user_id' => $pengguna->id,
                'user_name' => $pengguna->fisrt_name . ' ' . $pengguna->last_name,
                'user_email' => $pengguna->email,
            ]);

            // redirect ke homepage dengan pesan sukses
            return redirect('/')->with('success', 'Login berhasil! Selamat datang ' . $pengguna->fisrt_name);
        }

        // kalau gagal → balik ke login dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        // hapus session user
        $request->session()->forget(['user_id', 'user_name', 'user_email']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}