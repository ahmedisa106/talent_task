<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

class AuthController extends Controller
{
    /**
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        if (auth()->attempt($credentials)) {
            //auth()->user()->tokens()->delete();
            $token = auth('sanctum')->user()->createToken('authToken')->plainTextToken;
            $user = UserResource::make(auth()->user());
            $cookie = $this->getCookie($token);
            return final_response(message: __('custom.login_success'), data: $user)->withCookie($cookie);
        }
        return final_response(status: 401, message: __('custom.credentials_error'));

    }// end of login function

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $cookie = cookie()->forget(env('AUTH_COOKIE_NAME', 'AuthCookies'));
        auth('sanctum')->user()->currentAccessToken()->delete();
        return final_response(message: __('custom.logout_message'))->withCookie($cookie);
    }

    /**
     * @param $token
     * @return Application|CookieJar|\Illuminate\Foundation\Application|Cookie
     */
    private function getCookie($token): \Illuminate\Foundation\Application|CookieJar|Cookie|Application
    {
        return cookie(
            env('AUTH_COOKIE_NAME', 'AuthCookies'),
            $token,
            60,
            null,
            null,
            env('APP_DEBUG') ? false : true,
            true,
            false,
            'Strict'
        );
    }
}
