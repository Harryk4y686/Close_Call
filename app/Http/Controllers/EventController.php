<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Get authenticated user from either guard
     */
    protected function getAuthUser()
    {
        return Auth::guard('pengguna')->check() ? Auth::guard('pengguna')->user() : Auth::guard('web')->user();
    }

    /**
     * Display a listing of events.
     */
    public function index()
    {
        $user = $this->getAuthUser();
        
        // TEMPORARY FIX: Get the actual database user
        $dbUser = \App\Models\User::find($user->id);
        if (!$dbUser) {
            $dbUser = \App\Models\User::first();
        }
        
        // Get user's created events using the database user
        if ($dbUser) {
            $myEvents = Event::where('user_id', $dbUser->id)->latest()->get();
            
            // Get recommended events (published, upcoming, not created by user)
            $recommendedEvents = Event::published()
                ->upcoming()
                ->where('user_id', '!=', $dbUser->id)
                ->limit(4)
                ->get();
        } else {
            $myEvents = collect([]);
            $recommendedEvents = Event::published()->upcoming()->limit(4)->get();
        }
        
        // Get all upcoming events for calendar
        $upcomingEvents = Event::published()
            ->upcoming()
            ->get();
        
        // Get admin events for recommended section
        $adminEvents = \App\Models\AdminEvent::latest()->get();
        
        // Get user profile for header display
        $profile = $user->registeredProfile;
        
        return view('events', compact('myEvents', 'recommendedEvents', 'upcomingEvents', 'adminEvents', 'user', 'profile'));
    }

    /**
     * Show all events.
     */
    public function showAll()
    {
        $events = Event::published()
            ->upcoming()
            ->paginate(12);
        
        return view('events', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $user = $this->getAuthUser();
        $profile = $user->registeredProfile;
        return view('createevent', compact('user', 'profile'));
    }

    /**
     * Store a newly created event.
     */
    public function store(Request $request)
    {
        try {
            
            $validated = $request->validate([
                'event_title' => 'required|string|max:255',
                'event_description' => 'nullable|string',
                'event_date' => 'required|date|after_or_equal:today',
                'event_time' => 'required',
                'event_location' => 'required|string|max:255',
                'event_country' => 'nullable|string|max:100',
                'event_banner' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240', // 10MB max
            ]);

            $bannerPath = null;
            
            // Handle file upload - Use Laravel's storage system like profile pictures
            if ($request->hasFile('event_banner') && $request->file('event_banner')->isValid()) {
                $file = $request->file('event_banner');
                
                // Generate a unique filename
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Store in storage/app/public/event-banners (same pattern as profile pictures)
                $bannerPath = $file->storeAs('event-banners', $filename, 'public');
                
                // Log for debugging
                Log::info('Banner uploaded:', [
                    'path' => $bannerPath,
                    'full_path' => storage_path('app/public/' . $bannerPath),
                    'exists' => file_exists(storage_path('app/public/' . $bannerPath)),
                    'url' => asset('storage/' . $bannerPath)
                ]);
            }

            // Check if user is authenticated
            $user = $this->getAuthUser();
            if (!$user) {
                return redirect()->route('login')->with('error', 'You must be logged in to create events.');
            }

            // TEMPORARY FIX: Ensure user exists in database or use first available user
            $dbUser = \App\Models\User::find($user->id);
            if (!$dbUser) {
                // Use first available user or create a new one
                $dbUser = \App\Models\User::first();
                if (!$dbUser) {
                    // Create a default user
                    $dbUser = \App\Models\User::create([
                        'name' => 'Default User',
                        'email' => 'default@example.com',
                        'password' => bcrypt('password')
                    ]);
                }
            }

            $event = Event::create([
                'user_id' => $dbUser->id,
                'title' => $validated['event_title'],
                'description' => $validated['event_description'],
                'event_date' => $validated['event_date'],
                'event_time' => $validated['event_time'],
                'location' => $validated['event_location'],
                'country' => $validated['event_country'],
                'banner_image' => $bannerPath,
                'status' => 'published',
            ]);

            return redirect()->route('events')
                ->with('success', 'Event created successfully!' . ($bannerPath ? ' Banner uploaded successfully!' : ''));
                
        } catch (\Exception $e) {
            Log::error('Event creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);
            
            return back()->withErrors(['error' => 'Failed to create event: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified event.
     */
    public function show($id)
    {
        $event = Event::with(['creator', 'attendees'])->findOrFail($id);
        $user = $this->getAuthUser();
        
        // TEMPORARY FIX: Check with database user
        $dbUser = \App\Models\User::find($user->id);
        if (!$dbUser) {
            $dbUser = \App\Models\User::first();
        }
        
        $isAttending = $dbUser ? $event->attendees()->where('user_id', $dbUser->id)->exists() : false;
        
        // Get user profile for header display
        $profile = $user->registeredProfile;
        
        return view('viewevent', compact('event', 'isAttending', 'user', 'profile'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit($id)
    {
        $user = $this->getAuthUser();
        $event = Event::where('user_id', $user->id)->findOrFail($id);
        $profile = $user->registeredProfile;
        return view('editevents', compact('event', 'user', 'profile'));
    }

    /**
     * Update the specified event.
     */
    public function update(Request $request, $id)
    {
        $user = $this->getAuthUser();
        $event = Event::where('user_id', $user->id)->findOrFail($id);

        $validated = $request->validate([
            'event_title' => 'required|string|max:255',
            'event_description' => 'nullable|string',
            'event_date' => 'required|date|after_or_equal:today',
            'event_time' => 'required',
            'event_location' => 'required|string|max:255',
            'event_country' => 'nullable|string|max:100',
            'event_banner' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240',
        ]);

        // Handle file upload
        if ($request->hasFile('event_banner') && $request->file('event_banner')->isValid()) {
            // Delete old banner if exists
            if ($event->banner_image) {
                Storage::disk('public')->delete($event->banner_image);
            }
            
            $file = $request->file('event_banner');
            
            // Generate a unique filename
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Store in storage/app/public/event-banners
            $bannerPath = $file->storeAs('event-banners', $filename, 'public');
            $validated['banner_image'] = $bannerPath;
        }

        $event->update([
            'title' => $validated['event_title'],
            'description' => $validated['event_description'],
            'event_date' => $validated['event_date'],
            'event_time' => $validated['event_time'],
            'location' => $validated['event_location'],
            'country' => $validated['event_country'],
            'banner_image' => $validated['banner_image'] ?? $event->banner_image,
        ]);

        return redirect()->route('events.view', $event->id)
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event.
     */
    public function destroy($id)
    {
        $user = $this->getAuthUser();
        
        // TEMPORARY FIX: Get the actual database user
        $dbUser = \App\Models\User::find($user->id);
        if (!$dbUser) {
            $dbUser = \App\Models\User::first();
        }
        
        // Find event owned by the database user
        $event = Event::where('user_id', $dbUser->id)->where('id', $id)->firstOrFail();
        
        // Delete banner image if exists
        if ($event->banner_image) {
            Storage::disk('public')->delete($event->banner_image);
        }
        
        // Delete all attendees
        $event->attendees()->detach();
        
        $event->delete();

        return redirect()->route('events')
            ->with('success', 'Event deleted successfully!');
    }

    /**
     * Attend an event.
     */
    public function attend(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $user = $this->getAuthUser();

        // TEMPORARY FIX: Ensure user exists in database
        $dbUser = \App\Models\User::find($user->id);
        if (!$dbUser) {
            $dbUser = \App\Models\User::first();
            if (!$dbUser) {
                return back()->with('error', 'No valid user found.');
            }
        }

        // Check if already attending
        if ($event->attendees()->where('user_id', $dbUser->id)->exists()) {
            return back()->with('info', 'You have already attended this event.');
        }

        // Add user to attendees (use sync to avoid duplicates)
        try {
            $event->attendees()->attach($dbUser->id, ['status' => 'attending']);
            
            // Increment attendees count
            $event->increment('attendees_count');

            return back()->with('success', 'Successfully attended the event!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle duplicate entry gracefully
            if ($e->getCode() == 23000) { // Integrity constraint violation
                return back()->with('info', 'You have already attended this event.');
            }
            // Re-throw other exceptions
            throw $e;
        }
    }

    /**
     * Cancel attendance to an event.
     */
    public function cancelAttendance($id)
    {
        $event = Event::findOrFail($id);
        $user = $this->getAuthUser();

        // TEMPORARY FIX: Ensure user exists in database
        $dbUser = \App\Models\User::find($user->id);
        if (!$dbUser) {
            $dbUser = \App\Models\User::first();
            if (!$dbUser) {
                return back()->with('error', 'No valid user found.');
            }
        }

        // Check if attending
        if (!$event->attendees()->where('user_id', $dbUser->id)->exists()) {
            return back()->with('info', 'You are not attending this event.');
        }

        // Remove user from attendees
        $event->attendees()->detach($dbUser->id);
        
        // Decrement attendees count
        $event->decrement('attendees_count');

        return back()->with('success', 'Your attendance has been cancelled.');
    }

    /**
     * Get events for a specific date (for calendar).
     */
    public function getEventsByDate(Request $request)
    {
        $date = $request->input('date');
        
        $events = Event::published()
            ->whereDate('event_date', $date)
            ->get(['id', 'title', 'event_time', 'location']);

        return response()->json($events);
    }
}

