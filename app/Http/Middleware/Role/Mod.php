<?php

namespace App\Http\Middleware\Role;

use Closure;

class Mod
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
        if($request->user()->hasAnyRole([ROLE_ADMIN, ROLE_MOD])) {
            return $next($request);
        }
        return redirect('/');
    }
}
