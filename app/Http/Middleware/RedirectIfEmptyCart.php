<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfEmptyCart
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
        if (empty(session('cart'))) {
            return back();
        }

        return $next($request);
    }
}
