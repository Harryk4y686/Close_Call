<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

// halaman home/landing page tanpa akun
Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

// halaman home/landing page dengan akun (protected route - requires authentication)
Route::get('/landingpage2', function () {
    return view('landingpage2');
})->middleware(['auth'])->name('landingpage2');

// halaman register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');

// halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.post');

Route::post('/register', [RegisterController::class, 'processRegister'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



