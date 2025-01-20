<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admincheck
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
            if ($user['usertype'] == 0) {
                return $next($request);
            }
            return redirect()->route('dashboard')->with('error', 'Unauthorized Access');
        } else {
            return redirect()->route('login');
        }
        //return redirect()->route('login')->with('error', 'Unauthorized Access');
    }
}
