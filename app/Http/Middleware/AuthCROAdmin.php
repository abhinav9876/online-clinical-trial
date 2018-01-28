<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App;

class AuthCROAdmin
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
            $user_attr = App\CROUser::get(Auth::user()->id)->attribute;
            if ($user_attr->account_type == config('enum.cro_user_type.admin')) {
                return $next($request);
            }
        }
        return redirect('/');
    }
}
