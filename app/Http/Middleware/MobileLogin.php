<?php

namespace App\Http\Middleware;

use Closure;

class MobileLogin
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
        $request->merge([
            'grant_type' => 'password',
            'client_id' => config('auth.mobile.client_id'),
            'client_secret' => config('auth.mobile.client_secret'),
        ]);

        return $next($request);
    }
}
