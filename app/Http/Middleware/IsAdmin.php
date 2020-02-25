<?php

namespace App\Http\Middleware;

use Closure;
use auth;
class IsAdmin
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
        if (Auth::check() && Auth::user()->is_admin ==true) {
            return $next($request);
        }
        return redirect()->route('index');
    }
}
