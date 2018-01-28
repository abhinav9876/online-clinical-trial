<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (env('APP_ENV') === 'production' || env('APP_ENV') === 'staging') {
            \URL::forceScheme('https');
        }
    }

    public function register()
    {
        require_once __DIR__ . '/../Http/Helpers.php';
    }
}
