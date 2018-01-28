<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $route = LoginController::getHomeRoute();
        return redirect($route);
    }
}
