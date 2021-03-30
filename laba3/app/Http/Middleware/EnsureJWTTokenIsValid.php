<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;

class EnsureJWTTokenIsValid
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
        if ($request->cookie('token')) {

            try {
                JWT::decode($request->cookie('token'), env('APP_KEY', "key"), array('HS256'));
            }catch (\Exception $ex) {
                return response()->json(['error' => 'Invalid JWT.'], 401);
            }

        } else {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return $next($request);
    }
}
