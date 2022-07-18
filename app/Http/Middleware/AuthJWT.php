<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;

class AuthJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (!$token)
            return response()->json([
                'status'    => false,
                'message'   => 'Token diperlukan',
                'data'      => null
            ], 401);

        try {
            JWT::decode($token, new Key(env('APP_KEY'), 'HS256'));
        } catch (ExpiredException $e) {
            return response()->json([
                'status'    => false,
                'message'   => 'Token kadaluwarsa',
                'data'      => null
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => false,
                'message'   => 'Token tidak cocok',
                'data'      => null
            ], 400);
        }

        return $next($request);
    }
}
