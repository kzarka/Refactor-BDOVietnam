<?php

namespace App\Http\Middleware\Role;

use Closure;

class Admin
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
        if($request->user()->hasAnyRole([ROLE_ADMIN])) {
            return $next($request);
        }
        return redirect('/');
    }
}
