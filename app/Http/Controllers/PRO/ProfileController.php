<?php

namespace App\Http\Controllers\PRO;

use App\Http\Controllers\Controller;
use App;
use App\PRO;
use Illuminate\{
    Auth\Access\AuthorizationException, Http\Request, Support\Facades\Auth, Support\Facades\Lang, Support\Facades\Log, Support\Facades\Validator, Validation\Rule
};

class ProfileController extends Controller
{
    public function company()
    {
        try {
            $this->authorize('company_update', PRO::class);
        } catch (AuthorizationException $e) {
            return redirect(route('pro_home'));
        }

        $pro = App\PROUser::fetch(Auth::id())->attribute->pro;

        return view('pro.profile.company', [
            'activeMenuType' => config('menu.pro.company'),
            'pro'            => $pro
        ]);
    }

    public function update_company(Request $request)
    {
        try {
            $this->authorize('company_update', PRO::class);
        } catch (AuthorizationException $e) {
            return redirect(route('pro_home'));
        }

        $validator = Validator::make($request->all(), [
            'name'          => 'present|string|max:255',
            'zip_code'      => 'present|string|max:255',
            'address'       => 'present|string|max:255',
            'address_sup'   => 'present|string|max:255',
            'address_notes' => 'present|string|max:255',
            'contact'       => 'present|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())->withErrors($validator)->withInput();
        }

        $pro = App\PROUser::fetch(Auth::id())->attribute->pro;
        $pro->update_company($request);

        $message = Lang::get('pro/profile.company.update_success');
        return redirect(route('pro_profile_company'))->with('success_message', $message);
    }

    public function show()
    {
        $pro_user = App\PROUser::fetch(Auth::id());

        $data = [
            'activeMenuType' => config('menu.pro.profile'),
            'user'           => $pro_user
        ];

        return view('pro.profile.show', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'position' => 'present|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::id())->whereNull('deleted_at')],
            'password' => 'string|min:6|max:255|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())->withErrors($validator)->withInput();
        }

        $pro_user = App\PROUser::fetch(Auth::id());
        $pro_user->update_profile($request);

        return redirect(route('pro_home'));
    }
}
