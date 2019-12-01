<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
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
        if (auth()->check() && auth()->user()->active == STATUS_DISABLE) {
            $message = 'Tài khoản của bạn đã bị vô hiệu hóa.';
            return redirect()->route('login')->withMessage($message);
        }
        if (auth()->check() && auth()->user()->banned_until && now()->lessThan(auth()->user()->banned_until)) {
            $banned_days = now()->diffInDays(auth()->user()->banned_until);
            auth()->logout();
            $message = 'Tài khoản của bạn bị khóa trong '.$banned_days. ' ngày.';
            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
