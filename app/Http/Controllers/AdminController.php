<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\AdminUser;
use App\Models\Pengguna;
use App\Models\PenggunaRegistered;
use App\Models\AdminJob;
use App\Models\AdminEvent;
use App\Models\AdminCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        $stats = [
            'users' => PenggunaRegistered::count(),  // Count registered users
            'jobs' => AdminJob::count(),
            'events' => AdminEvent::count(),
            'companies' => AdminCompany::count(),
        ];
        
        return view('admin.AdminDashboard', compact('stats'));
    }

    // ========== USERS ==========
    
    /**
     * Show users database
     */
    public function users()
    {
        // Show regular users with their profiles
        $users = Pengguna::with('registeredProfile')->latest()->paginate(20);
        return view('admin.AdminUserDatabase', compact('users'));
    }


    /**
     * Show add user form
     */
    public function showUserAddForm()
    {
        // Admin adds regular users (pengguna table)
        return view('admin.adminUser');
    }


    /**
     * Store a new user (regular user in pengguna table)
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'phone_number' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'location' => 'required|string',
            'postal_code' => 'required|string',
            'password' => 'required|string|min:6',
            'portfolio' => 'nullable|file|max:2048',
            'profile_picture' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
        ]);

        // Hash the password
        $validated['password'] = bcrypt($validated['password']);

        try {
            // Create user in pengguna table (basic info)
            $penggunaData = [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'password' => $validated['password'],
            ];
            
            $user = Pengguna::create($penggunaData);
            
            // Create profile in pengguna_registered table (extended info)
            $profileData = [
                'pengguna_id' => $user->id,
                'date_of_birth' => $validated['date_of_birth'],
                'gender' => $validated['gender'],
                'location' => $validated['location'],
                'postal_code' => $validated['postal_code'],
            ];
            
         // Handle file uploads for profile
            if ($request->hasFile('profile_picture')) {
                $profileData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
            }
            
            if ($request->hasFile('banner_image')) {
                $profileData['banner_image'] = $request->file('banner_image')->store('banner_images', 'public');
            }
            
            if ($request->hasFile('resume')) {
                $profileData['resume_path'] = $request->file('resume')->store('resumes', 'public');
            }
            
            if ($request->hasFile('cv')) {
                $profileData['cv_path'] = $request->file('cv')->store('cvs', 'public');
            }
            
            if ($request->hasFile('portfolio')) {
                $profileData['portfolio_path'] = $request->file('portfolio')->store('portfolios', 'public');
            }
            
            $profile = PenggunaRegistered::create($profileData);
            
            // Calculate and save completion percentage
            $profile->updateCompletionPercentage();
            
            return redirect()->route('AdminUserDatabase')->with('success', 'User added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error creating user: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Show edit user form
     */
    public function showUserEditForm($id)
    {
        // Load regular user with profile
        $user = Pengguna::with('registeredProfile')->findOrFail($id);
        return view('admin.adminUserEdit', compact('user'));
    }

    /**
     * Update a user
     */
    public function updateUser(Request $request, $id)
{
    \Log::info('===== UPDATE USER METHOD CALLED =====');
    \Log::info('User ID: ' . $id);
    \Log::info('POST data: ' . json_encode($request->except(['profile_picture', 'banner_image', 'resume', 'cv', 'portfolio', 'delete_resume', 'delete_cv', 'delete_portfolio'])));
    
    $user = Pengguna::with('registeredProfile')->findOrFail($id);
    
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:pengguna,email,' . $id,
        'phone_number' => 'required|string',
        'date_of_birth' => 'required|date',
        'gender' => 'nullable|string',
        'location' => 'required|string',
        'postal_code' => 'required|string',
        'password' => 'nullable|string|min:6',
        'profile_picture' => 'nullable|image|max:2048',
        'banner_image' => 'nullable|image|max:2048',
        'resume' => 'nullable|file|max:10240',
        'cv' => 'nullable|file|max:10240',
        'portfolio' => 'nullable|file|max:10240',
    ]);

    // Hash password if provided
    if (!empty($request->password)) {
        $validated['password'] = bcrypt($request->password);
    } else {
        // Remove password from validated data if not provided
        unset($validated['password']);
    }

    \Log::info('Validated data: ' . json_encode($validated));
    
    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        $profilePath = $request->file('profile_picture')->store('profiles', 'public');
        $validated['profile_picture'] = $profilePath;
        \Log::info('Profile picture uploaded: ' . $profilePath);
    }
    
    // Handle banner image upload
    if ($request->hasFile('banner_image')) {
        $bannerPath = $request->file('banner_image')->store('banners', 'public');
        $validated['banner_image'] = $bannerPath;
        \Log::info('Banner image uploaded: ' . $bannerPath);
    }
    
    // Handle resume upload
    if ($request->hasFile('resume')) {
        $resumePath = $request->file('resume')->store('documents', 'public');
        $validated['resume'] = $resumePath;
        \Log::info('Resume uploaded: ' . $resumePath);
    } elseif ($request->has('delete_resume')) {
        $validated['resume'] = null;
        \Log::info('Resume marked for deletion');
    }

    // Handle CV upload
    if ($request->hasFile('cv')) {
        $cvPath = $request->file('cv')->store('documents', 'public');
        $validated['cv'] = $cvPath;
        \Log::info('CV uploaded: ' . $cvPath);
    } elseif ($request->has('delete_cv')) {
        $validated['cv'] = null;
        \Log::info('CV marked for deletion');
    }

    // Handle portfolio upload
    if ($request->hasFile('portfolio')) {
        $portfolioPath = $request->file('portfolio')->store('documents', 'public');
        $validated['portfolio'] = $portfolioPath;
        \Log::info('Portfolio uploaded: ' . $portfolioPath);
    } elseif ($request->has('delete_portfolio')) {
        $validated['portfolio'] = null;
        \Log::info('Portfolio marked for deletion');
    }

    // Update pengguna table fields (first_name, last_name, email, phone_number, password)
    $penggunaData = [
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
        'phone_number' => $validated['phone_number'],
    ];
    
    // Add password if provided
    if (isset($validated['password'])) {
        $penggunaData['password'] = $validated['password'];
    }
    
    $user->update($penggunaData);
    
    // Update or create pengguna_registered table fields (date_of_birth, gender, location, postal_code, profile_picture, banner_image, resume, cv, portfolio)
    $profileData = [
        'date_of_birth' => $validated['date_of_birth'],
        'gender' => $request->gender,
        'location' => $validated['location'],
        'postal_code' => $validated['postal_code'],
    ];
    
    // Add profile picture if uploaded
    if (isset($validated['profile_picture'])) {
        $profileData['profile_picture'] = $validated['profile_picture'];
    }
    
    // Add banner image if uploaded
    if (isset($validated['banner_image'])) {
        $profileData['banner_image'] = $validated['banner_image'];
    }
    
    // Add resume path if uploaded or mark for deletion
    if (isset($validated['resume'])) {
        $profileData['resume_path'] = $validated['resume'];
    } elseif ($request->has('delete_resume')) {
        $profileData['resume_path'] = null;
    }
    
    // Add CV path if uploaded or mark for deletion
    if (isset($validated['cv'])) {
        $profileData['cv_path'] = $validated['cv'];
    } elseif ($request->has('delete_cv')) {
        $profileData['cv_path'] = null;
    }
    
    // Add portfolio path if uploaded or mark for deletion
    if (isset($validated['portfolio'])) {
        $profileData['portfolio_path'] = $validated['portfolio'];
    } elseif ($request->has('delete_portfolio')) {
        $profileData['portfolio_path'] = null;
    }
    
    // Update or create the registered profile
    if ($user->registeredProfile) {
        $user->registeredProfile->update($profileData);
    } else {
        $user->registeredProfile()->create($profileData);
    }
    
    \Log::info('User and profile updated successfully');

    return redirect()->route('AdminUserDatabase')->with('success', 'User updated successfully!');
}

    /**
     * Delete a user
     */
    public function deleteUser($id)
    {
        $user = Pengguna::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    // ========== JOBS ==========
    
    /**
     * Show jobs database
     */
    public function jobs()
    {
        $jobs = AdminJob::latest()->paginate(20);
        return view('admin.AdminJobDatabase', compact('jobs'));
    }

    /**
     * Show add job form
     */
    public function showJobAddForm()
    {
        return view('admin.AdminJob');
    }

    public function storeJob(Request $request)
{
    $validated = $request->validate([
        'job_name' => 'required|string|max:255',
        'category' => 'required|string',
        'company' => 'required|string',
        'location' => 'required|string',
        'description' => 'required|string',
        'tags' => 'nullable|string',
        'profile_picture' => 'nullable|image|max:2048',
        'banner_image' => 'nullable|image|max:2048',
    ]);

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        $profilePath = $request->file('profile_picture')->store('profiles', 'public');
        $validated['profile_picture'] = $profilePath;
    }

    // Handle banner image upload
    if ($request->hasFile('banner_image')) {
        $bannerPath = $request->file('banner_image')->store('banners', 'public');
        $validated['banner_image'] = $bannerPath;
    }

    // Parse hashtags from tags input
    $tags = [];
    if (!empty($validated['tags'])) {
        // Split by # and filter empty values
        $tagsArray = array_filter(array_map('trim', explode('#', $validated['tags'])));
        // Remove empty first element if string starts with #
        $tags = array_values(array_filter($tagsArray, function($tag) {
            return !empty($tag);
        }));
    }

    // Assign tags to individual columns
    $validated['tag_1'] = $tags[0] ?? null;
    $validated['tag_2'] = $tags[1] ?? null;
    $validated['tag_3'] = $tags[2] ?? null;
    $validated['tag_4'] = $tags[3] ?? null;
    
    // Remove the original tags field
    unset($validated['tags']);

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        $validated['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
    }

    // Handle banner image upload
    if ($request->hasFile('banner_image')) {
        $validated['banner_image'] = $request->file('banner_image')->store('banners', 'public');
    }

    AdminJob::create($validated);

    return redirect()->route('AdminJobDatabase')->with('success', 'Job added successfully!');
}

    /**
     * Show edit job form
     */
    public function showJobEditForm($id)
    {
        $job = AdminJob::findOrFail($id);
        return view('admin.AdminJobEdit', compact('job'));
    }

    /**
     * Update a job
     */
    public function updateJob(Request $request, $id)
    {
        $job = AdminJob::findOrFail($id);
        
        $validated = $request->validate([
            'job_name' => 'required|string|max:255',
            'category' => 'required|string',
            'company' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'tags' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePath = $request->file('profile_picture')->store('profiles', 'public');
            $validated['profile_picture'] = $profilePath;
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('banners', 'public');
            $validated['banner_image'] = $bannerPath;
        }

        // Parse hashtags from tags input
        $tags = [];
        if (!empty($validated['tags'])) {
            $tagsArray = array_filter(array_map('trim', explode('#', $validated['tags'])));
            $tags = array_values(array_filter($tagsArray, function($tag) {
                return !empty($tag);
            }));
        }

        // Assign tags to individual columns
        $validated['tag_1'] = $tags[0] ?? null;
        $validated['tag_2'] = $tags[1] ?? null;
        $validated['tag_3'] = $tags[2] ?? null;
        $validated['tag_4'] = $tags[3] ?? null;
        
        unset($validated['tags']);

        $job->update($validated);

        return redirect()->route('AdminJobDatabase')->with('success', 'Job updated successfully!');
    }

    /**
     * Delete a job
     */
    public function deleteJob($id)
    {
        $job = AdminJob::findOrFail($id);
        $job->delete();
        return back()->with('success', 'Job deleted successfully.');
    }

    // ========== EVENTS ==========
    
    /**
     * Show events database
     */
    public function events()
    {
        $events = AdminEvent::latest()->paginate(20);
        return view('admin.AdminEventDatabase', compact('events'));
    }

    /**
     * Show add event form
     */
    public function showEventAddForm()
    {
        return view('admin.AdminEvent');
    }

/**
 * Store a new event
 */
public function storeEvent(Request $request)
{
    $validated = $request->validate([
        'event_name' => 'required|string|max:255',
        'location' => 'required|string',
        'attendees' => 'required|integer|min:0',
        'about' => 'required|string',
        'starting_date' => 'required|date',
        'banner_image' => 'nullable|image|max:2048',
    ]);

    // Handle banner image upload
    if ($request->hasFile('banner_image')) {
        $validated['banner_image'] = $request->file('banner_image')->store('banners', 'public');
    }

    AdminEvent::create($validated);

    return redirect()->route('AdminEventDatabase')->with('success', 'Event added successfully!');
}

    /**
     * Show edit event form
     */
    public function showEventEditForm($id)
    {
        $event = AdminEvent::findOrFail($id);
        return view('admin.AdminEventEdit', compact('event'));
    }

    /**
     * Update an event
     */
    public function updateEvent(Request $request, $id)
    {
        $event = AdminEvent::findOrFail($id);
        
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'location' => 'required|string',
            'attendees' => 'required|integer|min:0',
            'about' => 'required|string',
            'starting_date' => 'required|date',
            'banner_image' => 'nullable|image|max:2048',
        ]);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('banners', 'public');
            $validated['banner_image'] = $bannerPath;
        }

        $event->update($validated);

        return redirect()->route('AdminEventDatabase')->with('success', 'Event updated successfully!');
    }

    /**
     * Delete an event
     */
    public function deleteEvent($id)
    {
        $event = AdminEvent::findOrFail($id);
        $event->delete();
        return back()->with('success', 'Event deleted successfully.');
    }

    // ========== COMPANIES ==========
    
    /**
     * Show companies database
     */
    public function companies()
    {
        $companies = AdminCompany::latest()->paginate(20);
        return view('admin.AdminCompanyDatabase', compact('companies'));
    }

    /**
     * Show add company form
     */
    public function showCompanyAddForm()
    {
        return view('admin.AdminCompany');
    }

    /**
     * Store a new company
     */
    public function storeCompany(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'industry' => 'required|string',
            'about' => 'required|string',
            'company_size' => 'required|string',
            'closecall_employees' => 'required|integer|min:0',
            'hq' => 'required|string',
            'location' => 'required|string',
            'profile_picture' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('banners', 'public');
        }

        AdminCompany::create($validated);

        return redirect()->route('AdminCompanyDatabase')->with('success', 'Company added successfully!');
    }

    /**
     * Show edit company form
     */
    public function showCompanyEditForm($id)
    {
        $company = AdminCompany::findOrFail($id);
        return view('admin.AdminCompanyEdit', compact('company'));
    }

    /**
     * Update a company
     */
    public function updateCompany(Request $request, $id)
    {
        $company = AdminCompany::findOrFail($id);
        
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'industry' => 'required|string',
            'about' => 'required|string',
            'company_size' => 'required|string',
            'closecall_employees' => 'required|integer|min:0',
            'hq' => 'required|string',
            'location' => 'required|string',
            'profile_picture' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePath = $request->file('profile_picture')->store('profiles', 'public');
            $validated['profile_picture'] = $profilePath;
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('banners', 'public');
            $validated['banner_image'] = $bannerPath;
        }

        $company->update($validated);

        return redirect()->route('AdminCompanyDatabase')->with('success', 'Company updated successfully!');
    }

    /**
     * Delete a company
     */
    public function deleteCompany($id)
    {
        $company = AdminCompany::findOrFail($id);
        $company->delete();
        return back()->with('success', 'Company deleted successfully.');
    }
    
    // ========== ADMIN EVENTS PUBLIC VIEW ==========
    
    /**
     * View admin event details (for regular users)
     */
    public function viewAdminEvent($id)
    {
        $event = AdminEvent::findOrFail($id);
        
        // Get user for header
        $user = \Illuminate\Support\Facades\Auth::guard('admin_user')->check() ? \Illuminate\Support\Facades\Auth::guard('admin_user')->user() : 
                (\Illuminate\Support\Facades\Auth::guard('pengguna')->check() ? \Illuminate\Support\Facades\Auth::guard('pengguna')->user() : 
                \Illuminate\Support\Facades\Auth::guard('web')->user());
        $profile = $user && method_exists($user, 'registeredProfile') ? $user->registeredProfile : null;
        
        // Check if user is already attending
        $isAttending = \Illuminate\Support\Facades\DB::table('admin_event_attendees')
            ->where('admin_event_id', $event->id)
            ->where('user_id', $user->id)
            ->exists();
        
        return view('viewAdminEvent', compact('event', 'user', 'profile', 'isAttending'));
    }
    
    /**
     * Attend an admin event
     */
    public function attendAdminEvent($id)
    {
        $event = AdminEvent::findOrFail($id);
        
        // Get current user
        $user = \Illuminate\Support\Facades\Auth::guard('admin_user')->check() ? \Illuminate\Support\Facades\Auth::guard('admin_user')->user() : 
                (\Illuminate\Support\Facades\Auth::guard('pengguna')->check() ? \Illuminate\Support\Facades\Auth::guard('pengguna')->user() : 
                \Illuminate\Support\Facades\Auth::guard('web')->user());
        
        // Check if already attending
        $alreadyAttending = \Illuminate\Support\Facades\DB::table('admin_event_attendees')
            ->where('admin_event_id', $event->id)
            ->where('user_id', $user->id)
            ->exists();
        
        if ($alreadyAttending) {
            return back()->with('info', 'You are already registered for this event.');
        }
        
        // Add attendance record
        \Illuminate\Support\Facades\DB::table('admin_event_attendees')->insert([
            'admin_event_id' => $event->id,
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        // Increment attendees count
        $event->increment('attendees');
        
        return back()->with('success', 'You have successfully registered for this event!');
    }
    
    /**
     * Cancel attendance to an admin event
     */
    public function cancelAdminEventAttendance($id)
    {
        $event = AdminEvent::findOrFail($id);
        
        // Get current user
        $user = \Illuminate\Support\Facades\Auth::guard('admin_user')->check() ? \Illuminate\Support\Facades\Auth::guard('admin_user')->user() : 
                (\Illuminate\Support\Facades\Auth::guard('pengguna')->check() ? \Illuminate\Support\Facades\Auth::guard('pengguna')->user() : 
                \Illuminate\Support\Facades\Auth::guard('web')->user());
        
        // Remove attendance record
        $deleted = \Illuminate\Support\Facades\DB::table('admin_event_attendees')
            ->where('admin_event_id', $event->id)
            ->where('user_id', $user->id)
            ->delete();
        
        if ($deleted) {
            // Decrement attendees count (but not below 0)
            if ($event->attendees > 0) {
                $event->decrement('attendees');
            }
            return back()->with('success', 'Your attendance has been cancelled.');
        }
        
        return back()->with('info', 'You are not registered for this event.');
    }
}
