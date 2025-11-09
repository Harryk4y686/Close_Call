<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->verified) {
            // For AJAX requests, return JSON response
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please verify your email address before accessing this area.',
                    'redirect' => route('verification.notice')
                ], 403);
            }
            
            // For regular requests, redirect
            Auth::logout();
            return redirect()->route('verification.notice')
                ->with('error', 'Please verify your email address before accessing this area.');
        }

        return $next($request);
    }
}
