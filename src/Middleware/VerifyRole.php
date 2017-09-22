<?php

namespace selfreliance\fixroles\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use fixroles\Roles\Exceptions\RoleDeniedException;

/**
 * Class VerifyRole
 * @package Lemmas\Roles\Middleware
 */
class VerifyRole
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int|string $role
     * @param string $guard
     * @return mixed
     * @throws \Lemmas\Roles\Exceptions\RoleDeniedException
     */
    public function handle($request, Closure $next, $role, $guard = null)
    {

        if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->isRole($role)) {
            return $next($request);
        }

        return response('Forbidden: Role Denied.', 403);
        
    }

}
