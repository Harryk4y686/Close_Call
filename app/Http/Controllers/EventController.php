<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $user = Auth::user();
        
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
        
        return view('events', compact('myEvents', 'recommendedEvents', 'upcomingEvents'));
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
        return view('createevent');
    }

    /**
     * Store a newly created event.
     */
    public function store(Request $request)
    {
        try {
            // Debug: Log the request data
            Log::info('Event creation attempt', $request->all());
            
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
            
            // Handle file upload - Save directly to public folder
            if ($request->hasFile('event_banner') && $request->file('event_banner')->isValid()) {
                $file = $request->file('event_banner');
                Log::info('File upload detected', [
                    'filename' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime' => $file->getMimeType()
                ]);
                
                // Save directly to public/uploads/event-banners
                $directory = public_path('uploads/event-banners');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                    Log::info('Created directory: ' . $directory);
                }
                
                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Move file to public directory
                $file->move($directory, $filename);
                
                // Store relative path for database
                $bannerPath = 'uploads/event-banners/' . $filename;
                
                Log::info('File stored successfully', [
                    'path' => $bannerPath,
                    'full_path' => public_path($bannerPath),
                    'exists' => file_exists(public_path($bannerPath))
                ]);
            } else {
                Log::info('No valid file uploaded');
            }

            // Check if user is authenticated
            $user = Auth::user();
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
                Log::warning('User ID mismatch, using alternative user', [
                    'auth_user_id' => $user->id,
                    'db_user_id' => $dbUser->id
                ]);
            }

            Log::info('Creating event for user', ['user_id' => $dbUser->id, 'user_name' => $dbUser->name]);

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

            Log::info('Event created successfully', ['event_id' => $event->id]);

            return redirect()->route('events')
                ->with('success', 'Event created successfully!');
                
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
        $user = Auth::user();
        
        // TEMPORARY FIX: Check with database user
        $dbUser = \App\Models\User::find($user->id);
        if (!$dbUser) {
            $dbUser = \App\Models\User::first();
        }
        
        $isAttending = $dbUser ? $event->attendees()->where('user_id', $dbUser->id)->exists() : false;
        
        return view('viewevent', compact('event', 'isAttending'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit($id)
    {
        $event = Event::where('user_id', Auth::id())->findOrFail($id);
        return view('createevent', compact('event'));
    }

    /**
     * Update the specified event.
     */
    public function update(Request $request, $id)
    {
        $event = Event::where('user_id', Auth::id())->findOrFail($id);

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
        if ($request->hasFile('event_banner')) {
            // Delete old banner if exists
            if ($event->banner_image) {
                Storage::disk('public')->delete($event->banner_image);
            }
            
            $bannerPath = $request->file('event_banner')->store('event-banners', 'public');
            $event->banner_image = $bannerPath;
        }

        $event->update([
            'title' => $validated['event_title'],
            'description' => $validated['event_description'],
            'event_date' => $validated['event_date'],
            'event_time' => $validated['event_time'],
            'location' => $validated['event_location'],
            'country' => $validated['event_country'],
        ]);

        return redirect()->route('events.view', $event->id)
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        // TEMPORARY FIX: Get the actual database user
        $dbUser = \App\Models\User::find($user->id);
        if (!$dbUser) {
            $dbUser = \App\Models\User::first();
        }
        
        // Find event owned by the database user
        $event = Event::where('user_id', $dbUser->id)->where('id', $id)->firstOrFail();
        
        // Delete banner image if exists
        if ($event->banner_image && file_exists(public_path($event->banner_image))) {
            unlink(public_path($event->banner_image));
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
        $user = Auth::user();

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
            return back()->with('info', 'You are already attending this event.');
        }

        // Add user to attendees
        $event->attendees()->attach($dbUser->id, ['status' => 'attending']);
        
        // Increment attendees count
        $event->increment('attendees_count');

        return back()->with('success', 'Attend successfully');
    }

    /**
     * Cancel attendance to an event.
     */
    public function cancelAttendance($id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user();

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

