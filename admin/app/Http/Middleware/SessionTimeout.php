<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('lastActivityTime');
            if ($lastActivity && (time() - $lastActivity > 300)) { // 300 seconds = 5 minutes
                session()->forget('lastActivityTime');
                return redirect('/login')->with('message', 'You have been logged out due to inactivity.');
            }
            session(['lastActivityTime' => time()]);
        }

        return $next($request);
    }
}
