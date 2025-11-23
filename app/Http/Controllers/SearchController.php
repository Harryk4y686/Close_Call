<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminCompany;
use App\Models\AdminJob;
use App\Models\AdminEvent;

class SearchController extends Controller
{
    /**
     * Global search functionality
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return view('search-results', ['results' => [], 'query' => '']);
        }
        
        $results = [];
        
        // Search Companies
        $companies = AdminCompany::where('company_name', 'LIKE', "%{$query}%")
            ->orWhere('industry', 'LIKE', "%{$query}%")
            ->orWhere('about', 'LIKE', "%{$query}%")
            ->orWhere('location', 'LIKE', "%{$query}%")
            ->get();
        
        foreach ($companies as $company) {
            // Company Profile Result
            $results[] = [
                'type' => 'company',
                'title' => $company->company_name . ' - About Us | CloseCall',
                'url' => route('company.show', $company->id),
                'link_text' => 'closecall.com/company/' . $company->id,
                'description' => 'Learn more about ' . $company->company_name . '. ' . \Illuminate\Support\Str::limit($company->about, 100)
            ];
            
            // Company Jobs Result (if you want to show jobs section)
            $results[] = [
                'type' => 'company_jobs',
                'title' => $company->company_name . ' Jobs - Career Opportunities | CloseCall',
                'url' => route('company.show', $company->id) . '#jobs',
                'link_text' => 'closecall.com/company/' . $company->id . '/jobs',
                'description' => 'Explore exciting career opportunities at ' . $company->company_name . '. Find your dream job with competitive salaries and excellent benefits.'
            ];
            
            // Company Profile Result
            $results[] = [
                'type' => 'company_profile',
                'title' => $company->company_name . ' Company Profile | CloseCall',
                'url' => route('company.show', $company->id),
                'link_text' => 'closecall.com/company/' . $company->id,
                'description' => 'View the complete company profile of ' . $company->company_name . '. ' . $company->industry . ' | ' . $company->company_size . ' employees.'
            ];
        }
        
        // Get user for header
        $user = \Illuminate\Support\Facades\Auth::guard('admin_user')->check() ? \Illuminate\Support\Facades\Auth::guard('admin_user')->user() : 
                (\Illuminate\Support\Facades\Auth::guard('pengguna')->check() ? \Illuminate\Support\Facades\Auth::guard('pengguna')->user() : 
                \Illuminate\Support\Facades\Auth::guard('web')->user());
        $profile = $user && method_exists($user, 'registeredProfile') ? $user->registeredProfile : null;
        
        return view('search-results', compact('results', 'query', 'user', 'profile'));
    }
    
    /**
     * API endpoint for company search (used by search dropdown)
     */
    public function searchCompanies(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return response()->json([]);
        }
        
        // Search companies (case-insensitive)
        $companies = AdminCompany::where('company_name', 'LIKE', "%{$query}%")
            ->orWhere('industry', 'LIKE', "%{$query}%")
            ->select('id', 'company_name', 'industry', 'company_size')
            ->get();
        
        return response()->json($companies);
    }
}
