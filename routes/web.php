<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\Auth\UserRegistrationController;
use App\Http\Controllers\Auth\EmailVerificationController as CustomEmailVerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestRelationController;
use App\Http\Controllers\ChatController;
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
    return view('landing-page');
})->middleware(['auth'])->name('landing-page');

// Profile routes (protected - requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/completion', [ProfileController::class, 'getCompletionPercentage'])->name('profile.completion');
});

// complete profile route
Route::get('/complete-profile', function () {
    return redirect()->route('profile');
})->name('complete.profile');
 
// Jobs page (protected - requires authentication)
Route::get('/jobs', function () {
    $user = Auth::user();
    $profile = $user->registeredProfile;
    return view('jobs', compact('user', 'profile'));
})->middleware(['auth'])->name('jobs');
 
// (testing) halaman events
Route::get('/events', function () {
    return view('events');
})->name('events');
 
// Chat routes (protected - requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/chats', [ChatController::class, 'index'])->name('chats');
    Route::get('/chats/{user}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');
    Route::get('/api/chats/{user}/messages', [ChatController::class, 'getMessages'])->name('chats.messages');
    Route::get('/api/users', [ChatController::class, 'getUsersList'])->name('users.list');
});

// (testing) halaman AI
Route::get('/AI', function () {
    return view('AI');
})->name('AI');

// (testing) halaman bestpartner
Route::get('/bestpartnerjob ', function () {
    return view('bestpartnerjob');
})->name('bestpartnerjob');

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
        return redirect('/profile'); // redirect to profile page
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

// Handle verification code submission
Route::post('/email/verify-code', [EmailVerificationController::class, 'verifyCode'])
    ->middleware('auth')
    ->name('verification.code');

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

// Test Relationship Routes (for development/testing)
Route::get('/test-relations-page', function () {
    return view('test-relations');
})->name('test.relations.page');
Route::get('/test-relations', [TestRelationController::class, 'testRelations'])->name('test.relations');
Route::get('/show-users-profiles', [TestRelationController::class, 'showAllUsersWithProfiles'])->name('test.users.profiles');
Route::get('/test-progress', [TestRelationController::class, 'testProgressSaving'])->name('test.progress');

// Include debug routes
require __DIR__.'/debug.php';
