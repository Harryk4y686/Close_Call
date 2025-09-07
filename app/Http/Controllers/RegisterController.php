<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('register'); // Blade view untuk form register
    }

    public function processRegister(Request $request)
    {
        // validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'phone_number' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        // simpan data ke database (table: pengguna)
        try {
            $pengguna = Pengguna::create([
                'fisrt_name' => $request->name, // mapping 'name' to 'fisrt_name' column
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'country' => $request->country,
                'password' => bcrypt($request->password), // hash password for security
            ]);

            // redirect kembali dengan pesan sukses
            return redirect('/login')->with('success', 'Akun berhasil dibuat!');
        } catch (\Exception $e) {
            // Show the actual error for debugging
            return redirect()->back()
                ->withErrors(['error' => 'Error: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
