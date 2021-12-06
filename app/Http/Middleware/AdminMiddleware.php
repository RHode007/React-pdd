<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->status) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated. You are not an admin.'], 401);
            }
            abort(403, "You're not admin, you don't have the permission.");
        }

        return $next($request);
    }
}
