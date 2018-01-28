<?php

namespace App\Http\Controllers\CRO;

use App\Http\Controllers\Controller;
use App;
use App\Project;
use Validator;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth,
    Support\Facades\Log,
    Validation\Rule
};

class ProjectController extends Controller
{
    public function create()
    {
        $this->authorize('create', Project::class);

        $owner = App\CROUser::get(Auth::user()->id);
        $smos = App\SMO::orderBy('id')->get();
        $makers = App\CRO::makers();
        return view('cro/project/create', [
            'activeMenuType' => config('menu.cro.project_create'),
            'owner' => $owner,
            'smos' => $smos,
            'makers' => $makers,
        ]);
    }

    public function create_action(Request $request)
    {
        $this->authorize('create', Project::class);

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'protocol'  => 'present|string|max:255',
            'drug'      => 'present|string|max:255',
            'drug_type' => 'present|string', // string as numeric
            'maker'     => 'required|string', // string as numeric
            'category'  => 'present|string', // string as numeric
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        $owner = App\CROUser::get(Auth::user()->id);
        App\Project::form_create($request, $owner);
        return redirect(route('cro_project_list'));
    }

    public function list()
    {
        $this->authorize('index', Project::class);

        $user = App\CROUser::get(Auth::user()->id);
        return view('cro/project/list', [
            'activeMenuType' => config('menu.cro.project_list'),
            'projects' => $user->projects(),
            'cro' => $user->attribute->cro,
        ]);
    }

    public function edit($id)
    {
        $this->authorize('update', App\Project::find($id));

        $owner = App\CROUser::get(Auth::user()->id);
        $project = App\Project::find($id);
        $smos = App\SMO::orderBy('id')->get();
        $makers = App\CRO::makers();
        return view('cro/project/edit', [
            'activeMenuType' => config('menu.cro.project_list'),
            'project' => $project,
            'owner' => $owner,
            'smos' => $smos,
            'makers' => $makers,
        ]);
    }

    public function edit_action($id, Request $request)
    {
        $this->authorize('update', App\Project::find($id));

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'protocol'  => 'present|string|max:255',
            'drug'      => 'present|string|max:255',
            'drug_type' => 'present|string', // string as numeric
            'maker'     => 'required|string', // string as numeric
            'category'  => 'present|string', // string as numeric
        ]);
        if ($validator->fails()) {
            return redirect($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput();
        }

        $owner = App\CROUser::get(Auth::user()->id);
        $project = App\Project::find($id)->form_update($request, $owner);
        return redirect(route('cro_project_list'));
    }

    public function status_edit_action($id, $status, Request $request)
    {
        $this->authorize('update', App\Project::find($id));

        $project = App\Project::find($id);
        $project->status = $status;
        $project->save();
        return [
            'project_status' => $project->status,
            'project_status_label' => $project->status_display(),
        ];
    }
}
