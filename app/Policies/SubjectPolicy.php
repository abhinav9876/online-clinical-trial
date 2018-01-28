<?php

namespace App\Policies;

use App\{
    SMOUser,
    User,
    Subject
};
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
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

    public function update(User $user, Subject $subject)
    {
        if (!$user->is_smo()) return false;
        $smo_id = SMOUser::get($user->id)->attribute->smo_id;
        return $subject->post->smo_id == $smo_id;
    }

    public function create(User $user)
    {
        return env('APP_SMT_DEBUG');
    }
}
