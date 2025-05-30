<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Optional: Check if logged-in user is an admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Unauthorized access');
    }
}

