<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol
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
        if (!$request->secure() && (env('APP_ENV') === 'production' || env('APP_ENV') === 'staging')) {
            if ($_SERVER["HTTP_X_FORWARDED_PROTO"] != 'https') {
                return redirect()->secure($request->getRequestUri());
            }
        }

        return $next($request);
    }
}
