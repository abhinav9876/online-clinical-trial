<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthCRO
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
        $user = Auth::user();
        if ($user->type == config('enum.user_type.cro')) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
