<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cookie_name = env('AUTH_COOKIE_NAME','AuthCookies');
        if (!$request->bearerToken()) {
            if ($request->hasCookie($cookie_name)) {
                $token = $request->cookie($cookie_name);
                $request->headers->add([
                    'Authorization' => 'Bearer ' . $token
                ]);
            } else {
                return final_response(401, message: __('custom.unAuth'));
            }

        }
        return $next($request);
    }
}
