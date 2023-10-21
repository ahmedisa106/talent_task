<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        app()->setLocale(in_array($request->header('locale'), ['ar', 'en']) ? $request->header('locale') : config('app.locale'));
        return $request->expectsJson() ? null : route('login');
    }
}
