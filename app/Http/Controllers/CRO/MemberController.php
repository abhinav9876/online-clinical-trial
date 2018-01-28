<?php

namespace App\Http\Controllers\CRO;

use App\Http\Controllers\Controller;
use App;
use App\CROUser;
use Validator;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth,
    Validation\Rule
};

class MemberController extends Controller
{
    public function create()
    {
        $this->authorize('create', CROUser::class);

        return view('cro/member/create', [
            'activeMenuType' => config('menu.cro.member_create'),
        ]);
    }

    public function create_action(Request $request)
    {
        $this->authorize('create', CROUser::class);

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

        App\CROUser::form_create_member($request);
        return redirect(route('cro_member_list'));
    }

    public function list()
    {
        $this->authorize('index', CROUser::class);

        $user = App\CROUser::get(Auth::user()->id);
        $cro = $user->attribute->cro;
        $members = $cro->member_attributes()->paginate(env('LIST_ITEMS_PER_PAGE'));
        return view('cro/member/list', [
            'activeMenuType' => config('menu.cro.member_list'),
            'users' => $members,
        ]);
    }

    public function edit($id)
    {
        $user = App\CROUser::get($id);
        $this->authorize('update', $user);

        return view('cro/member/edit', [
            'activeMenuType' => config('menu.cro.member_list'),
            'user' => $user,
        ]);
    }

    public function edit_action($id, Request $request)
    {
        $user = App\CROUser::get($id);
        $this->authorize('update', $user);

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'position' => 'present|string|max:255',
            'email'           => [
                'required',
                'email',
                Rule::unique('users')->ignore($id)->whereNull('deleted_at'),
            ],
            'password' => 'string|min:6|max:255|confirmed',
            'status' => 'required|string|max:1',
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        App\CROUser::form_update_member($id, $request);
        return redirect(route('cro_member_list'));
    }
}
