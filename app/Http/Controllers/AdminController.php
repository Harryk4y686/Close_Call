<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
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
            'total_users' => User::count(),
            'total_events' => Event::count(),
            'total_jobs' => 0, // TODO: Add Job model when created
            'total_companies' => 0, // TODO: Add Company model when created
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Show users database
     */
    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    /**
     * Show jobs database
     */
    public function jobs()
    {
        // TODO: Implement when Job model is created
        $jobs = [];
        return view('admin.jobs', compact('jobs'));
    }

    /**
     * Show events database
     */
    public function events()
    {
        $events = Event::with('creator')->latest()->paginate(20);
        return view('admin.events', compact('events'));
    }

    /**
     * Show companies database
     */
    public function companies()
    {
        // TODO: Implement when Company model is created
        $companies = [];
        return view('admin.companies', compact('companies'));
    }

    /**
     * Delete a user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->is_admin) {
            return back()->with('error', 'Cannot delete admin users.');
        }
        
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    /**
     * Delete an event
     */
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        
        // Delete banner image if exists
        if ($event->banner_image) {
            \Storage::disk('public')->delete($event->banner_image);
        }
        
        $event->delete();
        return back()->with('success', 'Event deleted successfully.');
    }
}
