<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\JWTException;

class OptionalJWT extends BaseMiddleware
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
        try {
            // Check user based on token
            $this->auth->parseToken()->authenticate();
        } catch (JWTException $e) {
            // Do nothing if token is invalid or does not exist, just continue request
        }

        return $next($request);
    }
}
