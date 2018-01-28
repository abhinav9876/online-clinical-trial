<?php

namespace App\Http\Controllers\SMO;

use App\SMOProject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SMOProjectController extends Controller
{
    public function index()
    {
        return view('smo/projects/index', [
            'activeMenuType' => config('menu.smo.projects'),
            'smo_projects'   => SMOProject::getAllForSMOUser(Auth::id())
        ]);
    }
}
