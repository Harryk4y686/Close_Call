<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check both guards
        if (!auth()->guard('web')->check() && !auth()->guard('pengguna')->check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = auth()->guard('web')->check() ? auth()->guard('web')->user() : auth()->guard('pengguna')->user();

        if (!isset($user->is_admin) || !$user->is_admin) {
            return redirect('/profile')->with('error', 'Unauthorized access. Admin privileges required.');
        }

        return $next($request);
    }
}
