<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationCompletion
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->has_completed_registration) {

            if (!$request->routeIs('registration.create')) {
                return redirect()->route('registration.create');
            }
        }
        return $next($request);
    }
}
