<?php

namespace App\Http\Controllers\SMO;

use App;

use App\{
    Http\Controllers\Controller,
    Http\Requests\SavePost,
    Post,
    Project,
    SMOUser
};

use Illuminate\{
    Support\Facades\Auth,
    Support\Facades\DB,
    Support\Facades\Log
};

class PostController extends Controller
{
    public function index($project_id)
    {
        $this->authorize('post_index', Project::find($project_id));

        return view('smo/posts/index', [
            'activeMenuType' => NULL,
            'posts'          => Post::getAllInProjectsForSMOUser($project_id, Auth::id()),
            'project_id'     => $project_id
        ]);
    }

    public function new($project_id)
    {
        $this->authorize('post_create', Project::find($project_id));

        $project = Project::find($project_id);

        $post = new Post([
            'title'                        => '',
            'description'                  => '',
            'facility_name'                => '',
            'facility_zip_code'            => '',
            'facility_address'             => '',
            'facility_address_sup'         => '',
            'facility_address_notes'       => '',
            'required_no_scr'              => '',
            'crc_name'                     => '',
            'crc_email'                    => '',
            'selection_criteria'           => '',
            'exclusion_criteria'           => '',
            'participation_benefits'       => '',
            'exam_day_notes'               => '',
            'start_recruitment_at'         => '',
            'end_recruitment_at'           => '',
            'exam_schedule_items'          => [],
            'reward_items'                 => [],
            'required_subject_gender'      => config('enum.post_gender_conditions.any'),
            'minimum_subject_age'          => 0,
            'maximum_subject_age'          => 0,
            'prefers_hidden_facility_name' => false
        ]);

        return view('smo/posts/new', [
            'activeMenuType' => config('menu.smo.new_post'),
            'post'           => $post,
            'project_id'     => $project_id,
            'project'        => $project,
            'drug_info'      => $project->drug_info(),
        ]);
    }

    public function create($project_id, SavePost $request)
    {
        $this->authorize('post_create', Project::find($project_id));

        $current_user_id = Auth::id();
        $input = $request->all();

        $post = new Post([
            'user_id'                      => $current_user_id,
            'smo_id'                       => SMOUser::get($current_user_id)->attribute->smo_id,
            'project_id'                   => $project_id,
            'title'                        => $input['title'],
            'description'                  => $input['description'],
            'facility_name'                => $input['facility_name'],
            'facility_zip_code'            => $input['facility_zip_code'],
            'facility_address'             => $input['facility_address'],
            'facility_address_sup'         => $input['facility_address_sup'],
            'facility_address_notes'       => $input['facility_address_notes'],
            'required_no_scr'              => intval($input['required_no_scr']),
            'crc_name'                     => $input['crc_name'],
            'crc_email'                    => $input['crc_email'],
            'required_subject_gender'      => $input['required_subject_gender'],
            'minimum_subject_age'          => $input['minimum_subject_age'],
            'maximum_subject_age'          => $input['maximum_subject_age'],
            'prefers_hidden_facility_name' => isset($input['prefers_hidden_facility_name']) ? $input['prefers_hidden_facility_name'] : false
        ]);

        $datetimeKeys = [
            'start_recruitment_at',
            'end_recruitment_at',
        ];
        foreach ($datetimeKeys as $key) {
            $post[$key] = App\Helper\changeLocaleDisplayToModel($input[$key]);
        }

        $nullableKeys = [
            'selection_criteria',
            'exclusion_criteria',
            'participation_benefits',
            'exam_day_notes',
        ];

        foreach ($nullableKeys as $key) {
            if (!empty($input[$key])) {
                $post[$key] = $input[$key];
            }
        }

        foreach (['exam_schedule_items', 'reward_items'] as $key) {
            $value = array_filter($input[$key], function ($v) {
                return $v !== NULL;
            }, ARRAY_FILTER_USE_BOTH);

            if (count($value)) {
                $post[$key] = json_encode($value); // resulting in {foo: NULL, bar: NULL}
            }
        }

        // todo: if !save?
        $post->save();

        return redirect(route('smo_project_posts', ['id' => $project_id]));
    }

    public function edit($project_id, $post_id)
    {
        $this->authorize('update', Post::find($post_id));

        $post = Post::find($post_id);
        $post->exam_schedule_items = json_decode($post->exam_schedule_items, true);
        $post->reward_items = json_decode($post->reward_items, true);
        $project = Project::find($project_id);

        return view('smo/posts/edit', [
            'activeMenuType' => config('menu.smo.post_list'),
            'post'           => $post,
            'project_id'     => $project_id,
            'project'        => $project,
            'drug_info'      => $project->drug_info(),
        ]);
    }

    public function update($project_id, $post_id, SavePost $request)
    {
        $this->authorize('update', Post::find($post_id));

        $post = Post::find($post_id);
        $input = $request->all();

        $post->title = $input['title'];
        $post->description = $input['description'];
        $post->facility_name = $input['facility_name'];
        $post->facility_zip_code = $input['facility_zip_code'];
        $post->facility_address = $input['facility_address'];
        $post->facility_address_sup = $input['facility_address_sup'];
        $post->facility_address_notes = $input['facility_address_notes'];
        $post->required_no_scr = intval($input['required_no_scr']);
        $post->crc_name = $input['crc_name'];
        $post->crc_email = $input['crc_email'];
        $post->required_subject_gender = $input['required_subject_gender'];
        $post->minimum_subject_age = $input['minimum_subject_age'];
        $post->maximum_subject_age = $input['maximum_subject_age'];
        $post->prefers_hidden_facility_name = isset($input['prefers_hidden_facility_name']) ? $input['prefers_hidden_facility_name'] : false;

        $datetimeKeys = [
            'start_recruitment_at',
            'end_recruitment_at'
        ];
        foreach ($datetimeKeys as $key) {
            if (!empty($input[$key])) {
                $input[$key] = App\Helper\changeLocaleDisplayToModel($input[$key]);
            }
        }

        $nullableKeys = [
            'selection_criteria',
            'exclusion_criteria',
            'participation_benefits',
            'exam_day_notes',
            'start_recruitment_at',
            'end_recruitment_at'
        ];

        foreach ($nullableKeys as $key) {
            if (!empty($input[$key])) {
                $post->$key = $input[$key];
            }
        }

        foreach ($input['exam_schedule_items'] as &$val) {
            $val['conduct_at'] = App\Helper\changeLocaleDisplayToModel($val['conduct_at']);
        }

        foreach (['exam_schedule_items', 'reward_items'] as $key) {
            $post->$key = json_encode($input[$key]);
        }

        $post->save();

        return redirect(route('smo_project_posts', ['id' => $project_id]));
    }

    public function delete($project_id, $post_id)
    {
        $this->authorize('update', Post::find($post_id));

        $post = Post::find($post_id);
        $post->delete();
        return redirect(route('smo_project_posts', ['id' => $project_id]));
    }
}
