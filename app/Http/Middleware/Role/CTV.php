<?php

namespace App\Http\Middleware\Role;
use Illuminate\Support\Facades\Auth;
use Closure;

class CTV
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->authorizeRoles([ROLE_ADMIN, ROLE_MOD, ROLE_CTV])) {
            return $next($request);
        }
        return redirect('/');
    }
}
