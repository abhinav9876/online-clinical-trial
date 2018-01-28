<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App;
use Illuminate\Support\Facades\Log;

class AuthPROAdmin
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user->type == config('enum.user_type.pro')) {
            $user_attr = App\PROUser::fetch($user->id)->attribute;
            if ($user_attr->account_type == config('enum.pro_account_type.admin')) {
                return $next($request);
            }
        }
        return redirect('/');
    }
}
