<?php

namespace App\Http\Controllers\PRO;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('pro/home', [
            'activeMenuType' => config('menu.pro.home')
        ]);
    }
}
