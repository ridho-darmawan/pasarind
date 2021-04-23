<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Auth;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    public function bearerToken()
    {
        $header = $this->header('Authorization', '');
        if (Str::startsWith($header, 'Bearer ')) {
            return Str::substr($header, 7);
        }
    }
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();

        if (!$token) {
            
            return response()->json([
                "message"=> "Token not provided.",
                "results"=> null,
                "code"=>401,
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                "message"=> "Provided token is expired.",
                "results"=> null,
                "code"=>400,
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                "message"=> "An error while decoding token.",
                "results"=> null,
                "code"=>400,
            ], 400);
        }
        $user = User::find($credentials->sub->id);
        // Now let's put the user in the request class so that you can grab it from there
        $request->auth = $user;
        return $next($request);
    }
}
