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
        $userRoles = Auth::user()->getRoleNames();

        $hasRequiredRole = false;
        foreach ($roles as $role) {
            if ($userRoles->contains($role)) {
                $hasRequiredRole = true;
                break;
            }
        }

        if ($hasRequiredRole) {
            return $next($request);
        }

        if ($this->isApi()) {
            return response()->json(["message" => "You don't have permission to access"], 403);
        } else {
            return redirect()->route('profile')->with('toast_message', 'You don\'t have permission to access');
        }
    }
}
