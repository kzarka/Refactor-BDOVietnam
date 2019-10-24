<?php

namespace App\Http\Middleware\Role;

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
        if($request->user()->hasAnyRole([ROLE_ADMIN, ROLE_MOD, ROLE_CTV])) {
            return $next($request);
        }
        return redirect('/');
    }
}
