<?php

namespace App\Http\Middleware;

use App\Http\Traits\ResponseTraits;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    use ResponseTraits;

    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRole = Auth::user()->role_id;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        $is_api_request = $request->route()->getPrefix() === 'api';

        if ($is_api_request) {
            return $this->failedResponse("You don't have permission to access", 403);
        } else {
            return redirect()->route('users.profile');
            // return back()->withError("You don't have permission to access");
        }
    }
}
