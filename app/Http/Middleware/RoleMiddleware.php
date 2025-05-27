<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated via the admin guard
        $adminuser= Auth::guard('admin')->user();

        if (!$adminuser) {
            return redirect('admin/login'); // Redirect to login if not authenticated
        }

        // Check if the user has the required role
        if ($adminuser->roleType !== $role) {
            return abort(403, message: 'You do not have access to this resource.'); // Return 403 for unauthorized access
        }

        return $next($request); // Proceed to the next middleware/handler
    }

}
