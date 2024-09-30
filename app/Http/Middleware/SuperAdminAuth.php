<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the superadmin is authenticated using the 'superadmin' guard
        if (!Auth::guard('superadmin')->check()) {
            // If not authenticated, redirect to superadmin login page
            return redirect()->route('superadmin.login');
        }

        return $next($request);
    }
}
