<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRequestType
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
        // Check if the route has '/mobile' in its URL
        $requestType = $request->is('api/jobseeker/mobile/*') ? 'mobile' : 'web';

        // Validate request type
        if (!in_array($requestType, ['web', 'mobile'])) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid request type'
            ], 400);
        }

        // Add request type to request object for use in controllers
        $request->merge(['request_type' => $requestType]);

        return $next($request);
    }
}
