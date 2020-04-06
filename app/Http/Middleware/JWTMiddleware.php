<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTMiddleware extends BaseMiddleware
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
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            Log::error($exception);
            if ($exception instanceof TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid']);
            }

            if ($exception instanceof TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired']);
            }

            return response()->json(['status' => 'Authorization Token not found']);
        }

        return $next($request);
    }
}
