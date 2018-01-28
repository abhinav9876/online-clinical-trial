<?php

namespace App\Http\Controllers\SMO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Subject;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('smo/home', [
            'activeMenuType' => config('menu.smo.home'),
            'test' => 'foo'
        ]);
    }
}
