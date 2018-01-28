<?php

namespace App\Http\Controllers\SMO;

use App\Http\Controllers\Controller;
use App;
use App\SMOUser;
use Validator;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth,
    Support\Facades\Log,
    Validation\Rule
};

class MemberController extends Controller
{
    public function create()
    {
        $this->authorize('create', SMOUser::class);

        return view('smo/member/create', [
            'activeMenuType' => config('menu.smo.member_create'),
        ]);
    }
    
    public function create_action(Request $request)
    {
        $this->authorize('create', SMOUser::class);

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'position' => 'present|string|max:255',
            'email'    => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|string|min:6|max:255|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        App\SMOUser::form_create_member($request);
        return redirect(route('smo_member_list'));
    }
    
    public function list()
    {
        $this->authorize('index', SMOUser::class);

        $user = App\SMOUser::get(Auth::id());
        $smo = $user->attribute->smo;
        $members = $smo->member_attributes()->paginate(env('LIST_ITEMS_PER_PAGE'));
        return view('smo/member/list', [
            'activeMenuType' => config('menu.smo.member_list'),
            'users' => $members,
        ]);
    }
    
    public function edit($id)
    {
        $user = App\SMOUser::get($id);
        $this->authorize('update', $user);

        $user = App\SMOUser::get($id);
        return view('smo/member/edit', [
            'activeMenuType' => config('menu.smo.member_list'),
            'user' => $user,
        ]);
    }

    public function edit_action($id, Request $request)
    {
        $user = App\SMOUser::get($id);
        $this->authorize('update', $user);

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'position' => 'present|string|max:255',
            'email'    => [
                'required',
                'email',
                Rule::unique('users')->ignore($id)->whereNull('deleted_at'),
            ],
            'password' => 'string|min:6|max:255|confirmed',
            'status'   => 'required|string|max:1',
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        App\SMOUser::form_update_member($id, $request);
        return redirect(route('smo_member_list'));
    }
}
