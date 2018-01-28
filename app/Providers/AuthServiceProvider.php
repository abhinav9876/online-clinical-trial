<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App;
use Illuminate\Support\Facades\Auth;
use Config;

class AuthServiceProvider extends ServiceProvider
{
    /**
    * The policy mappings for the application.
    *
    * @var array
    */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Project' => 'App\Policies\ProjectPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
        'App\Subject' => 'App\Policies\SubjectPolicy',
        'App\CROUser' => 'App\Policies\CROUserPolicy',
        'App\SMOUser' => 'App\Policies\SMOUserPolicy',
        'App\PROUser' => 'App\Policies\PROUserPolicy',
        'App\CRO' => 'App\Policies\CROPolicy',
        'App\SMO' => 'App\Policies\SMOPolicy',
        'App\PRO' => 'App\Policies\PROPolicy',
    ];
    
    /**
    * Register any authentication / authorization services.
    *
    * @return void
    */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('cro-admin', function ($user) {
            $user_attr = App\CROUser::get(Auth::id())->attribute;
            if ($user_attr->account_type == config('enum.cro_user_type.admin')) {
                return true;
            }
            return false;
        });
        Gate::define('smo-admin', function ($user) {
            $user_attr = App\SMOUser::get(Auth::id())->attribute;
            if ($user_attr->account_type == config('enum.smo_user_type.admin')) {
                return true;
            }
            return false;
        });
        Gate::define('pro-admin', function ($user) {
            $user_attr = App\PROUser::fetch(Auth::id())->attribute;
            if ($user_attr->account_type == config('enum.pro_account_type.admin')) {
                return true;
            }
            return false;
        });
    }
}
