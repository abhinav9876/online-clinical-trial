<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App;
use App\SMO;
use Validator;
use Illuminate\{
    Http\Request,
    Validation\Rule
};

class SMOController extends Controller
{
    public function create()
    {
        $this->authorize('create', SMO::class);

        return view('admin/smo/create', [
            'activeMenuType' => config('menu.admin.smo_create'),
        ]);
    }

    public function create_action(Request $request)
    {
        $this->authorize('create', SMO::class);

        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'admin_name'    => 'required|string|max:255',
            'admin_email'   => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'zip_code'      => 'present|string|max:255',
            'address'       => 'present|string|max:255',
            'address_sup'   => 'present|string|max:255',
            'address_notes' => 'present|string|max:255',
            'password'      => 'required|string|min:6|max:255|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        App\SMO::form_create($request);
        return redirect(route('admin_smo_list'));
    }
    
    public function list()
    {
        $this->authorize('index', SMO::class);

        $smos = App\SMO::orderBy('id')->paginate(env('LIST_ITEMS_PER_PAGE'));
        return view('admin/smo/list', [
            'activeMenuType' => config('menu.admin.smo_list'),
            'smos' => $smos,
        ]);
    }
    
    public function edit($id)
    {
        $this->authorize('update', SMO::class);

        $smo = App\SMO::find($id);
        $admin = $smo->admin_user();
        return view('admin/smo/edit', [
            'activeMenuType' => config('menu.admin.smo_list'),
            'smo' => $smo,
            'admin' => $admin,
        ]);
    }

    public function edit_action($id, Request $request)
    {
        $this->authorize('update', SMO::class);

        $smo_admin = SMO::find($id)->admin_user();
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'admin_name'    => 'required|string|max:255',
            'admin_email'   => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($smo_admin->id)->whereNull('deleted_at'),
            ],
            'zip_code'      => 'present|string|max:255',
            'address'       => 'present|string|max:255',
            'address_sup'   => 'present|string|max:255',
            'address_notes' => 'present|string|max:255',
            'password'      => 'string|min:6|max:255|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        App\SMO::form_update($id, $request);
        return redirect(route('admin_smo_list'));
    }
}
