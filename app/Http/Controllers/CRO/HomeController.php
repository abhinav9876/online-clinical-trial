<?php

namespace App\Http\Controllers\CRO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('cro/home', [
            'activeMenuType' => config('menu.cro.home'),
        ]);
    }
}
