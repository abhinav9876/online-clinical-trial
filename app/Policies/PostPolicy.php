<?php

namespace App\Policies;

use App\{
    SMOUser,
    User,
    Post
};
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

    public function update(User $user, Post $post)
    {
        if (!$user->is_smo()) return false;
        $smo_id = SMOUser::get($user->id)->attribute->smo_id;
        return $post->smo->id == $smo_id;
    }

    public function subject_index(User $user, Post $post)
    {
        if (!$user->is_smo()) return false;
        $smo_id = SMOUser::get($user->id)->attribute->smo_id;
        return $post->smo->id == $smo_id;
    }
}
