<?php

namespace App\Http\Controllers\Admin;

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

class CROController extends Controller
{
    public function create()
    {
        $this->authorize('create', CRO::class);

        return view('admin/cro/create', [
            'activeMenuType' => config('menu.admin.cro_create'),
        ]);
    }
    
    public function create_action(Request $request)
    {
        $this->authorize('create', CRO::class);
        
        $validator = Validator::make($request->all(), [
            'name'                  => 'required|string|max:255',
            'group_type'            => 'required|string', // string as numeric
            'admin_name'            => 'required|string|max:255',
            'admin_email'           => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'zip_code'              => 'present|string|max:255',
            'address'               => 'present|string|max:255',
            'address_sup'           => 'present|string|max:255',
            'address_notes'         => 'present|string|max:255',
            'password'              => 'required|string|min:6|max:255|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        App\CRO::form_create($request);
        return redirect(route('admin_cro_list'));
    }
    
    public function list()
    {
        $this->authorize('index', CRO::class);

        $cros = App\CRO::orderBy('id')->paginate(env('LIST_ITEMS_PER_PAGE'));
        return view('admin/cro/list', [
            'activeMenuType' => config('menu.admin.cro_list'),
            'cros' => $cros,
        ]);
    }
    
    public function edit($id)
    {
        $this->authorize('update', CRO::class);

        $cro = App\CRO::find($id);
        $admin = $cro->admin_user();
        return view('admin/cro/edit', [
            'activeMenuType' => config('menu.admin.cro_list'),
            'cro' => $cro,
            'admin' => $admin,
        ]);
    }
    public function edit_action($id, Request $request)
    {
        $this->authorize('update', CRO::class);

        $cro_admin = CRO::find($id)->admin_user();
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'group_type'    => 'required|string', // string as numeric
            'admin_name'    => 'required|string|max:255',
            'admin_email'   => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($cro_admin->id)->whereNull('deleted_at'),
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

        App\CRO::form_update($id, $request);
        return redirect(route('admin_cro_list'));
    }

    public function project_index($cro_id)
    {
        $this->authorize('project_index', CRO::class);

        $cro = App\CRO::find($cro_id);
        $projects = $cro->projects()->paginate(env('LIST_ITEMS_PER_PAGE'));

        return view('admin/cro/projects', [
            'activeMenuType' => config('menu.admin.cro_list'),
            'cro' => $cro,
            'projects' => $projects,
        ]);
    }
}
