<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthenticationToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Log the request data as an array (no need for concatenation)
        Log::info('Request received:', $request->all());

        // Check if the request has a bearer token
        if (!$request->bearerToken()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access. Token is missing.'
            ], 401);
        }

        // Try to authenticate using the provided token
        $user = Auth::guard('sanctum')->user();

        // If authentication fails (no valid token), return unauthorized
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access. Invalid token.'
            ], 401);
        }

        // Token is valid, proceed to next request
        return $next($request);
    }
}
