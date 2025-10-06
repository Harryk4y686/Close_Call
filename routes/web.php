<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\Auth\UserRegistrationController;
use App\Http\Controllers\Auth\EmailVerificationController as CustomEmailVerificationController;
use App\Mail\VerifyEmailUser;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

// halaman home/landing page tanpa akun
Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

// halaman home/landing page dengan akun (protected route - requires authentication and verification)
Route::get('/landingpage2', function () {
    return view('landingpage2');
})->middleware(['auth', 'email.verified'])->name('landingpage2');

// halaman register
Route::get('/register', [UserRegistrationController::class, 'showRegistrationForm'])->name('register');

// halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.post');

Route::post('/register', [UserRegistrationController::class, 'register'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Protected routes
Route::middleware('auth')->group(function () {
    // Show verification notice
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // Handle verification link
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home'); // or wherever
    })->middleware(['signed'])->name('verification.verify');

    // Resend verification email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});
// Auth::routes(['verify' => true]);

// Route::get('/login', [LoginController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('login');


// Manual email verification route
Route::post('/email/manual-verify', [EmailVerificationController::class, 'manualVerify'])
    ->middleware('auth')
    ->name('verification.manual');

use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    // Mail::raw('This is a test email from Laravel.', function ($message) {
    //     $message->to('your-real-email@gmail.com')
    //         ->subject('Test Email');
    // });


    return 'Email sent!';
});

// Custom Email Verification System Routes
Route::post('/resend-verification', [UserRegistrationController::class, 'resendVerification'])->name('verification.resend');
Route::get('/verify-email', [CustomEmailVerificationController::class, 'verify'])->name('email.verify');
