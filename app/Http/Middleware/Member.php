<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Member
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Check if the user is authenticated
       if (auth()->check()) {
            $user = auth()->user();
            if ($user->is_admin == 0 || $user->is_admin == 1) {
                return $next($request);
            } else{
                return redirect()->route('dashboard');
            }
        }

        // If not authenticated, redirect to login
        return redirect()->route('login');
    }
}
