<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Atasan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role == "user") {
            return redirect('dashboard');
        }
        if (Auth::user()->role == "admin") {
            return redirect('admin/dashboard');
        }
        if (Auth::user()->role == "atasan") {
            return $next($request);
        }
    }
}
