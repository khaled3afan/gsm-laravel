<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class chackCategory
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
        $count= Category::all()->count();
        if($count == 0) {
            session()->flash('error', 'please add 1 category at least');
            return redirect()->route('categories.create');
        }
        return $next($request);
    }
}
