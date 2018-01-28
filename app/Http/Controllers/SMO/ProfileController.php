<?php

namespace App\Http\Controllers\SMO;

use App\Http\Controllers\Controller;
use App;
use App\SMO;
use Validator;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth,
    Support\Facades\Log,
    Validation\Rule
};

class ProfileController extends Controller
{
    public function company()
    {
        $this->authorize('company_update', SMO::class);

        $smo = App\SMOUser::get(Auth::id())->attribute->smo;
        return view('smo/profile/company', [
            'activeMenuType' => config('menu.smo.company'),
            'smo' => $smo,
        ]);
    }
    public function company_action(Request $request)
    {
        $this->authorize('company_update', SMO::class);

        $validator = Validator::make($request->all(), [
            'name'          => 'present|string|max:255',
            'zip_code'      => 'present|string|max:255',
            'address'       => 'present|string|max:255',
            'address_sup'   => 'present|string|max:255',
            'address_notes' => 'present|string|max:255',
            'contact'       => 'present|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        $smo = App\SMOUser::get(Auth::id())->attribute->smo;
        $smo->update_company($request);
        return redirect(route('smo_home'));
    }
    public function user()
    {
        $user = App\SMOUser::get(Auth::id());
        return view('smo/profile/user', [
            'activeMenuType' => config('menu.smo.user'),
            'user' => $user,
        ]);
    }
    public function user_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'position' => 'present|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::id())->whereNull('deleted_at')],
            'password' => 'string|min:6|max:255|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        $user = App\SMOUser::get(Auth::id());
        $user->update_profile($request);
        return redirect(route('smo_home'));
    }
}
