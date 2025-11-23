<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminCompany;
use App\Models\AdminJob;

class CompanyController extends Controller
{
    /**
     * Display a specific company page
     */
    public function showCompany($id)
    {
        // Fetch the company
        $company = AdminCompany::findOrFail($id);
        
        // Fetch admin jobs (for Related Jobs section) - max 3
        $relatedJobs = AdminJob::latest()->take(3)->get();
        
        // Get user for header (same pattern as other views)
        $user = \Illuminate\Support\Facades\Auth::guard('admin_user')->check() ? \Illuminate\Support\Facades\Auth::guard('admin_user')->user() : 
                (\Illuminate\Support\Facades\Auth::guard('pengguna')->check() ? \Illuminate\Support\Facades\Auth::guard('pengguna')->user() : 
                \Illuminate\Support\Facades\Auth::guard('web')->user());
        $profile = $user && method_exists($user, 'registeredProfile') ? $user->registeredProfile : null;
        
        // Return view with company data and related jobs
        return view('company', compact('company', 'relatedJobs', 'user', 'profile'));
    }
}
