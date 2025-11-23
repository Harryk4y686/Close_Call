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
use App\Http\Controllers\EventController;
use App\Http\Controllers\RelationshipTestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SearchController;
use App\Mail\VerifyEmailUser;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

// Debug route to check users
require __DIR__.'/debug-users.php';

// halaman home/landing page tanpa akun
Route::get('/', function () {
    return view('landingPage');
})->name('landingpage');

// halaman home/landing page dengan akun (protected route - requires authentication and verification)
Route::get('/landingpage2', function () {
    // Get user from any guard
    $user = Auth::guard('admin_user')->check() ? Auth::guard('admin_user')->user() : 
            (Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : 
            Auth::guard('web')->user());
    $profile = $user && method_exists($user, 'registeredProfile') ? $user->registeredProfile : null;
    return view('landing-page', compact('user', 'profile'));
})->middleware(['auth:web,pengguna,admin_user'])->name('landing-page');

// Profile routes (protected - requires authentication and verification for updates)
Route::middleware(['auth:web,pengguna,admin_user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('edit.profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::get('/profile/completion', [ProfileController::class, 'getCompletionPercentage'])->name('profile.completion');
});

// complete profile route
Route::get('/complete-profile', function () {
    return redirect()->route('profile');
})->name('complete.profile');
 
// Jobs page (protected - requires authentication and verification)
Route::get('/jobs', function () {
    // Get user from any guard (admin_user, pengguna, or web)
    $user = Auth::guard('admin_user')->check() ? Auth::guard('admin_user')->user() : 
            (Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : 
            Auth::guard('web')->user());
    
    // For admin users, they may not have a registered profile, so make it optional
    $profile = $user && method_exists($user, 'registeredProfile') ? $user->registeredProfile : null;
    
    // Fetch admin jobs - max 3 for open jobs section, all for detailed section
    $openJobs = \App\Models\AdminJob::latest()->take(3)->get();
    $detailedJobs = \App\Models\AdminJob::latest()->get();
    
    return view('jobs', compact('user', 'profile', 'openJobs', 'detailedJobs'));
})->middleware(['auth:web,pengguna,admin_user'])->name('jobs');

// Delete job (AJAX)
Route::delete('/jobs/{id}', function ($id) {
    $job = \App\Models\AdminJob::findOrFail($id);
    $job->delete();
    
    return response()->json(['success' => true, 'message' => 'Job deleted successfully']);
})->middleware(['auth:web,pengguna,admin_user'])->name('jobs.delete');

// Jobs Categories page (protected - requires authentication and verification)
Route::get('/jobs/categories', function () {
    return view('jobsCategories');
})->middleware(['auth:web,pengguna,admin_user'])->name('jobs.categories');

// Jobs Opened page (protected - requires authentication and verification)
Route::get('/jobs/opened', function () {
    // Get user
    $user = Auth::guard('admin_user')->check() ? Auth::guard('admin_user')->user() : 
            (Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : 
            Auth::guard('web')->user());
    $profile = $user && method_exists($user, 'registeredProfile') ? $user->registeredProfile : null;
    
    // Fetch all admin jobs for display
    $jobs = \App\Models\AdminJob::latest()->get();
    
    return view('jobsOpened', compact('jobs', 'user', 'profile'));
})->middleware(['auth:web,pengguna,admin_user'])->name('jobs.opened');
 
// Events routes (protected - requires authentication)
Route::middleware(['auth:web,pengguna,admin_user'])->group(function () {
    // Main events page
    Route::get('/events', [EventController::class, 'index'])->name('events');
    
    // See all events page
    Route::get('/events/all/list', [EventController::class, 'showAll'])->name('events.all');
    
    // Create new event page (form)
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    
    // Store new event
    Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
    
    // View specific event page
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.view');
    
    // Edit event
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    
    // Delete event
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    
    // Attend/Cancel attendance
    Route::post('/events/{id}/attend', [EventController::class, 'attend'])->name('events.attend');
    Route::post('/events/{id}/cancel-attendance', [EventController::class, 'cancelAttendance'])->name('events.cancel');
    
    // Get events by date (AJAX)
    Route::get('/api/events/by-date', [EventController::class, 'getEventsByDate'])->name('events.by.date');
    
    // Admin events view (for viewing admin-created events from the events page)
    Route::get('/admin-events/{id}', [AdminController::class, 'viewAdminEvent'])->name('admin.events.view');
    Route::post('/admin-events/{id}/attend', [AdminController::class, 'attendAdminEvent'])->name('admin.events.attend');
    Route::post('/admin-events/{id}/cancel', [AdminController::class, 'cancelAdminEventAttendance'])->name('admin.events.cancel');
    
    // Company pages (for viewing admin-created companies)
    Route::get('/company/{id}', [CompanyController::class, 'showCompany'])->name('company.show');
    
    // Global search
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    
    // API endpoint for company search (used by dropdown)
    Route::get('/api/companies/search', [SearchController::class, 'searchCompanies'])->name('api.companies.search');
});
 
// Chat routes (protected - requires authentication)
Route::middleware(['auth:web,pengguna,admin_user'])->group(function () {
    Route::get('/chats', [ChatController::class, 'index'])->name('chats');
    Route::get('/chats/{user}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');
    Route::get('/api/chats/{user}/messages', [ChatController::class, 'getMessages'])->name('chats.messages');
    Route::get('/api/users', [ChatController::class, 'getUsersList'])->name('users.list');
    
    // New conversation and search endpoints
    Route::post('/api/chats/conversations', [ChatController::class, 'createConversation'])->name('chats.conversations.create');
    Route::get('/api/chats/conversations', [ChatController::class, 'getConversations'])->name('chats.conversations');
    Route::get('/api/chats/search', [ChatController::class, 'search'])->name('chats.search');
});

// (testing) halaman AI
Route::get('/AI', function () {
    return view('AI');
})->name('AI');

// Best Partner specific pages
Route::get('/aboutbestpartner', function () {
    return view('aboutBestPartner');
})->name('aboutbestpartner');

Route::get('/bestpartnerjob', function () {
    return view('bestPartnerJob');
})->name('bestpartnerjob');

// (testing) halaman admin user add
Route::get('/adminuseradd', function () {
    return view('admin.AdminUser');
})->name('adminuseradd');

// (testing) halaman admin user edit
Route::get('/adminuseredit', function () {
    return view('admin.AdminUserEdit');
})->name('adminuseredit');

// (testing) halaman admin job add
Route::get('/adminjobadd', function () {
    return view('admin.AdminJob');
})->name('adminjobadd');

// (testing) halaman admin job edit
Route::get('/adminjobedit', function () {
    return view('admin.AdminJobEdit');
})->name('adminjobedit');

// (testing) halaman admin company add
Route::get('/admincompanyadd', function () {
    return view('admin.AdminCompany');
})->name('admincompanyadd');

// (testing) halaman admin company edit
Route::get('/admincompanyedit', function () {
    return view('admin.AdminCompanyEdit');
})->name('admincompanyedit');

// (testing) halaman admin event add
Route::get('/admineventadd', function () {
    return view('admin.AdminEvent');
})->name('admineventadd');

// (testing) halaman admin event edit
Route::get('/admineventedit', function () {
    return view('admin.AdminEventEdit');
})->name('admineventedit');

// halaman register
Route::get('/register', [UserRegistrationController::class, 'showRegistrationForm'])->name('register');

// halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.post');

Route::post('/register', [UserRegistrationController::class, 'register'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password Routes
Route::get('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'resetPassword'])->name('password.update');



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

// New Relationship Test Routes
Route::get('/test-relationships', [RelationshipTestController::class, 'testRelationships'])->name('test.relationships');
Route::get('/test-chat-relationships', [RelationshipTestController::class, 'testChatRelationships'])->name('test.chat.relationships');

// Admin Routes (protected - requires admin access)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
    Route::get('/events', [AdminController::class, 'events'])->name('events');
    Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
    
    // Delete routes
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::delete('/events/{id}', [AdminController::class, 'deleteEvent'])->name('events.delete');
});

// Admin Routes - New naming convention (matches blade file route names)
// Dashboard
Route::get('/AdminDashboard', [AdminController::class, 'index'])->middleware(['auth', 'is_admin'])->name('AdminDashboard');

// Users
Route::get('/AdminUserDatabase', [AdminController::class, 'users'])->middleware(['auth', 'is_admin'])->name('AdminUserDatabase');
Route::get('/adminuseradd', [AdminController::class, 'showUserAddForm'])->middleware(['auth', 'is_admin'])->name('adminuseradd');
Route::post('/adminuseradd', [AdminController::class, 'storeUser'])->name('adminuseradd.store'); // TEMPORARILY REMOVED MIDDLEWARE FOR TESTING
Route::get('/adminuseredit/{id}', [AdminController::class, 'showUserEditForm'])->middleware(['auth', 'is_admin'])->name('adminuseredit');
Route::put('/adminuseredit/{id}', [AdminController::class, 'updateUser'])->middleware(['auth', 'is_admin'])->name('adminuseredit.update');
Route::delete('/adminuserdelete/{id}', [AdminController::class, 'deleteUser'])->middleware(['auth', 'is_admin'])->name('adminuserdelete');

// Jobs
Route::get('/AdminJobDatabase', [AdminController::class, 'jobs'])->middleware(['auth', 'is_admin'])->name('AdminJobDatabase');
Route::get('/adminjobadd', [AdminController::class, 'showJobAddForm'])->middleware(['auth', 'is_admin'])->name('adminjobadd');
Route::post('/adminjobadd', [AdminController::class, 'storeJob'])->middleware(['auth', 'is_admin'])->name('adminjobadd.store');
Route::get('/adminjobedit/{id}', [AdminController::class, 'showJobEditForm'])->middleware(['auth', 'is_admin'])->name('adminjobedit');
Route::put('/adminjobedit/{id}', [AdminController::class, 'updateJob'])->middleware(['auth', 'is_admin'])->name('adminjobedit.update');
Route::delete('/adminjobdelete/{id}', [AdminController::class, 'deleteJob'])->middleware(['auth', 'is_admin'])->name('adminjobdelete');

// Events
Route::get('/AdminEventDatabase', [AdminController::class, 'events'])->middleware(['auth', 'is_admin'])->name('AdminEventDatabase');
Route::get('/admineventadd', [AdminController::class, 'showEventAddForm'])->middleware(['auth', 'is_admin'])->name('admineventadd');
Route::post('/admineventadd', [AdminController::class, 'storeEvent'])->middleware(['auth', 'is_admin'])->name('admineventadd.store');
Route::get('/admineventedit/{id}', [AdminController::class, 'showEventEditForm'])->middleware(['auth', 'is_admin'])->name('admineventedit');
Route::put('/admineventedit/{id}', [AdminController::class, 'updateEvent'])->middleware(['auth', 'is_admin'])->name('admineventedit.update');
Route::delete('/admineventdelete/{id}', [AdminController::class, 'deleteEvent'])->middleware(['auth', 'is_admin'])->name('admineventdelete');

// Companies
Route::get('/AdminCompanyDatabase', [AdminController::class, 'companies'])->middleware(['auth', 'is_admin'])->name('AdminCompanyDatabase');
Route::get('/admincompanyadd', [AdminController::class, 'showCompanyAddForm'])->middleware(['auth', 'is_admin'])->name('admincompanyadd');
Route::post('/admincompanyadd', [AdminController::class, 'storeCompany'])->middleware(['auth', 'is_admin'])->name('admincompanyadd.store');
Route::get('/admincompanyedit/{id}', [AdminController::class, 'showCompanyEditForm'])->middleware(['auth', 'is_admin'])->name('admincompanyedit');
Route::put('/admincompanyedit/{id}', [AdminController::class, 'updateCompany'])->middleware(['auth', 'is_admin'])->name('admincompanyedit.update');
Route::delete('/admincompanydelete/{id}', [AdminController::class, 'deleteCompany'])->middleware(['auth', 'is_admin'])->name('admincompanydelete');


// Debug routes
if (config('app.debug')) {
    require __DIR__.'/debug-events.php';
    require __DIR__.'/test-auth.php';
}
