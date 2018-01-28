<?php

namespace App\Policies;

use App\{
    PROUser, SMOUser, User, CROUser, Project
};
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        return $user->is_cro();
    }

    public function create(User $user)
    {
        return $user->is_cro();
    }

    public function update(User $user, Project $project)
    {
        if (!$user->is_cro()) return false;
        $cro_id = CROUser::get($user->id)->attribute->cro_id;
        return $project->cro_id == $cro_id;
    }

    public function post_index(User $user, Project $project)
    {
        if ($user->is_smo()) {
            $smo_id = SMOUser::get($user->id)->attribute->smo_id;
            return $project->smos()->pluck('smo_id')->contains($smo_id);
        } else if ($user->is_pro()) {
            $pro_id = PROUser::fetch($user->id)->attribute->pro_id;
            return $project->pros()->pluck('pro_id')->contains($pro_id);
        } else if ($user->is_cro()) {
            $cro_id = CROUser::get($user->id)->attribute->cro_id;
            return $project->is_project_cro($cro_id);
        }

        return false;
    }

    public function post_create(User $user, Project $project)
    {
        if (!$user->is_smo()) return false;
        $smo_id = SMOUser::get($user->id)->attribute->smo_id;
        return $project->smos()->pluck('smo_id')->contains($smo_id);
    }
}
