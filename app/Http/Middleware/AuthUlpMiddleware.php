<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthUlpMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
        // Belum login → redirect login
        return redirect()->route('login');
    }

    // Hanya blokir kalau role bukan ulp untuk route ulp
    if ($request->routeIs('dashboard.ulp.*') && Auth::user()->role !== 'ulp') {
        abort(403, 'Unauthorized.');
    }

    return $next($request);

    }
}
