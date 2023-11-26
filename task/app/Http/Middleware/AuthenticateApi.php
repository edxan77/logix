<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->bearerToken()) {
            try {
                $decodedTokenData = JWT::decode($request->bearerToken(), new Key(config('auth.jwt.key'), 'HS256'));
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => 'invalid_token_format'
                ]);
            }

            if (!User::where('email', $decodedTokenData->username)->exists() || !$request->bearerToken()) {
                return response()->json([
                    'message' => 'invalid_token',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'unauthorized_request',
            ]);
        }

        return $next($request);
    }
}
