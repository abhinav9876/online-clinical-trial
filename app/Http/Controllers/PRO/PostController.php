<?php

namespace App\Http\Controllers\PRO;

use App;

use App\{
    Http\Controllers\Controller, Post, Project, Subject
};

use Illuminate\{
    Auth\Access\AuthorizationException, Pagination\Paginator, Pagination\LengthAwarePaginator, Support\Facades\DB
};

class PostController extends Controller
{
    public function index($project_id)
    {
        try {
            $this->authorize('post_index', Project::find($project_id));
        } catch (AuthorizationException $e) {
            return redirect(route('pro_home'));
        }

        $posts = DB::table('posts')
            ->select('posts.*')
            ->addSelect('projects.name AS project_name')
            ->join('projects', 'posts.project_id', '=', 'projects.id')
            ->where('posts.project_id', $project_id)
            ->orderBy('posts.id')
            ->get();

        $subjects = Subject::whereIn('post_id', $posts->pluck('id')->toArray())->get();
        foreach ($posts as $post) {
            $post_subjects = $subjects->where('post_id', $post->id);
            $post->num_subj = $post_subjects->sum();
            $post->num_subj_default = $post_subjects->where('status', config('enum.subject_status.default'))->sum();
            $post->num_subj_phone_1 = $post_subjects->where('status', config('enum.subject_status.phone_1'))->sum();
            $post->num_subj_phone_2 = $post_subjects->where('status', config('enum.subject_status.phone_2'))->sum();
            $post->num_subj_phone_3 = $post_subjects->where('status', config('enum.subject_status.phone_3'))->sum();
            $post->num_subj_disqualified = $post_subjects->where('status', config('enum.subject_status.disqualified'))->sum();
        }

        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $per_page = intval(env('LIST_ITEMS_PER_PAGE'));
        $current_page_subjects = $posts->slice(($current_page - 1) * $per_page, $per_page)->all();
        $paginated_posts = new LengthAwarePaginator($current_page_subjects, count($posts), $per_page, $current_page, [
            'path' => Paginator::resolveCurrentPath()
        ]);

        return view('pro.posts.index', [
            'activeMenuType' => NULL,
            'posts'          => $paginated_posts
        ]);
    }
}
