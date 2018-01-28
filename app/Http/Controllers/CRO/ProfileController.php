<?php

namespace App\Http\Controllers\CRO;

use App\Http\Controllers\Controller;
use App;
use App\CRO;
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
        $this->authorize('company_update', CRO::class);

        $cro = App\CROUser::get(Auth::id())->attribute->cro;
        return view('cro/profile/company', [
            'activeMenuType' => config('menu.cro.company'),
            'cro' => $cro,
        ]);
    }
    public function company_action(Request $request)
    {
        $this->authorize('company_update', CRO::class);

        $validator = Validator::make($request->all(), [
            'name'          => 'present|string|max:255',
            'zip_code'      => 'present|string|max:255',
            'address'       => 'present|string|max:255',
            'address_sup'   => 'present|string|max:255',
            'address_notes' => 'present|string|max:255',
            'contact' => 'present|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        $cro = App\CROUser::get(Auth::id())->attribute->cro;
        $cro->update_company($request);
        return redirect(route('cro_home'));
    }
    
    public function user()
    {
        $user = App\CROUser::get(Auth::id());
        return view('cro/profile/user', [
            'activeMenuType' => config('menu.cro.user'),
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

        $user = App\CROUser::get(Auth::id());
        $user->update_profile($request);
        return redirect(route('cro_home'));
    }
    
    public function billing()
    {
        $this->authorize('billing_update', CRO::class);

        $user = App\CROUser::get(Auth::id());
        $cro = $user->attribute->cro;
        return view('cro/profile/billing', [
            'activeMenuType' => config('menu.cro.billing'),
            'cro' => $cro,
        ]);
    }
    public function billing_action(Request $request)
    {
        $this->authorize('billing_update', CRO::class);

        $validator = Validator::make($request->all(), [
            'company'       => 'present|string|max:255',
            'person'        => 'present|string|max:255',
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

        $user = App\CROUser::get(Auth::id());
        $cro = $user->attribute->cro;
        $cro->update_billing($request);
        return redirect(route('cro_home'));
    }
}
