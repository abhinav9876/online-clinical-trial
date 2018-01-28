<?php

namespace App\Http\Controllers\PRO;

use App\PROProject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PROProjectController extends Controller
{
    public function index()
    {
        return view('pro.projects.index', [
            'activeMenuType' => config('menu.pro.projects'),
            'pro_projects'   => PROProject::getAllForPROUser(Auth::id())
        ]);
    }
}
