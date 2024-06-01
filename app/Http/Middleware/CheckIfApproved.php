<?php
// app/Http/Middleware/CheckIfApproved.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfApproved
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_approved) {
            return $next($request);
        }

        Auth::logout();
        return redirect('/login')->with('error', 'Your account is not approved yet.');
    }
}
