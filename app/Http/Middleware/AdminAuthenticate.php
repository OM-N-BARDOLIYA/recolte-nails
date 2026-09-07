<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized admin access.'], 403);
            }
            return redirect()->route('admin.login')->withErrors(['email' => 'Please sign in to access the Atelier CMS Dashboard.']);
        }

        return $next($request);
    }
}
