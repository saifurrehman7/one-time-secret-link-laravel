<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PasswordProtect
{
    public function handle(Request $request, Closure $next)
    {
        // // Skip password page itself
        // if ($request->is('password') || $request->is('password/check')) {
        //     return $next($request);
        // }

        // // Check if user already unlocked session
        // if (!session()->has('site_unlocked')) {
        //     return redirect('/password');
        // }

        return $next($request);
    }
}
