<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Cookie;

class SetCookieCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (!$request->cookie('cart')) {
            $response->headers->setCookie(
                new Cookie('cart', str_random(), 0x7FFFFFFF)
            );
        }

        return $response;
    }
}