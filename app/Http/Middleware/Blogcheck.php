<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Blogcheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = Auth::user();
            if ($user['usertype'] == 5 || $user['usertype'] == 1 || $user['usertype'] == 0 || $user['usertype'] == 2) {
                return $next($request);
            }
            return redirect()->route('dashboard')->with('error', 'Unauthorized Access');
        }
        return redirect()->route('login')->with('error', 'Unauthorized Access');
    }
}
