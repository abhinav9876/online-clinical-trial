<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthPRO
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->type == config('enum.user_type.pro')) {
            return $next($request);
        }

        return redirect('/');
    }
}
