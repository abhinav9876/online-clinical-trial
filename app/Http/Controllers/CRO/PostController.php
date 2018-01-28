<?php

namespace App\Http\Controllers\CRO;

use App;

use App\{
    Http\Controllers\Controller,
    Http\Requests\SavePost,
    Post,
    Project,
    CROUser
};

use Illuminate\{
    Support\Facades\Auth,
    Support\Facades\DB,
    Support\Facades\Log
};
// first change
class PostController extends Controller
{
  public function index($project_id)
  {
    $this->authorize('post_index', Project::find($project_id));
    return view('cro/posts/index', [
        'activeMenuType' => NULL,
        'posts'          => Post::getAllInProjectsForCROUser($project_id, Auth::id()),
        'project_id'     => $project_id
    ]);
  }

  public function set_status($project_id, $post)
  {
    $this->authorize('post_index', Project::find($project_id));
    $status = $input['status'];
    $post->status = $status;
    $post->save();

    return view('cro/posts/index', [
        'activeMenuType' => NULL,
        'posts'          => Post::getAllInProjectsForCROUser($project_id, Auth::id()),
        'project_id'     => $project_id
    ]);
  }
}
