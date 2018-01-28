<?php

namespace App\Http\Controllers\PRO;

use App\Http\Controllers\Controller;
use App;
use App\PROUser;
use Illuminate\{
    Auth\Access\AuthorizationException, Http\Request, Support\Facades\Auth, Support\Facades\Validator, Validation\Rule
};

class MemberController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('index', PROUser::class);
        } catch (AuthorizationException $e) {
            return redirect(route('pro_home'));
        }

        $user = App\PROUser::fetch(Auth::id());
        $pro = $user->attribute->pro;
        $paged_member_attributes = $pro->member_attributes()->paginate(env('LIST_ITEMS_PER_PAGE'));

        return view('pro.members.index', [
            'activeMenuType'    => config('menu.pro.members_index'),
            'member_attributes' => $paged_member_attributes,
        ]);
    }

    public function new()
    {
        try {
            $this->authorize('create', PROUser::class);
        } catch (AuthorizationException $e) {
            return redirect(route('pro_home'));
        }

        return view('pro.members.new', [
            'activeMenuType' => config('menu.pro.members_new')
        ]);
    }

    public function create(Request $request)
    {
        try {
            $this->authorize('create', PROUser::class);
        } catch (AuthorizationException $e) {
            return redirect(route('pro_home'));
        }

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'position' => 'present|string|max:255',
            'email'    => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|string|min:6|max:255|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())->withErrors($validator)->withInput();
        }

        App\PROUser::form_create_member($request);
        return redirect(route('pro_members_index'));
    }

    public function edit($id)
    {
        $pro_user = App\PROUser::fetch($id);

        try {
            $this->authorize('update', $pro_user);
        } catch (AuthorizationException $e) {
            return redirect(route('pro_home'));
        }

        return view('pro.members.edit', [
            'activeMenuType' => config('menu.smo.member_list'),
            'user'           => $pro_user,
        ]);
    }

    public function update($id, Request $request)
    {
        $pro_user = App\PROUser::fetch($id);

        try {
            $this->authorize('update', $pro_user);
        } catch (AuthorizationException $e) {
            return redirect(route('pro_home'));
        }

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'position' => 'present|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($id)->whereNull('deleted_at')],
            'password' => 'string|min:6|max:255|confirmed',
            'status'   => 'required|string|max:1',
        ]);

        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())->withErrors($validator)->withInput();
        }

        try {
            App\PROUser::form_update_member($id, $request);
        } catch (\Exception $e) {
            return redirect()->back()->withException($e);
        }

        return redirect(route('pro_members_index'));
    }
}
