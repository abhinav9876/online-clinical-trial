<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        return self::getHomeRoute();
    }

    protected function credentials(Request $request)
    {
        $request = $request->only($this->username(), 'password');
        $request['status'] = config('enum.user_status.active');
        return $request;
    }

    static public function getHomeRoute()
    {
        if (Auth::check()) {
            $user = Auth::user();
            switch ($user->type) {
                case config('enum.user_type.admin'):
                    return route('admin_home');
                    break;
                case config('enum.user_type.cro'):
                    return route('cro_home');
                    break;
                case config('enum.user_type.smo'):
                    return route('smo_home');
                    break;
                case config('enum.user_type.pro'):
                    return route('pro_home');
                default:
                    return route('login');
            }
        } else {
            return route('login');
        }
    }
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
