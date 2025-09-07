<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

// halaman home/homepage
Route::get('/', function () {
    return view('homepage');
})->name('home');

// halaman register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');

// halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.post');

Route::post('/register', [RegisterController::class, 'processRegister'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



