<?php

namespace App\Policies;

use App\User;
use App\SMOUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class SMOUserPolicy
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
        if (!$user->is_smo()) return false;
        if (!SMOUser::get($user->id)->is_admin()) return false;
        return true;
    }

    public function create(User $user)
    {
        if (!$user->is_smo()) return false;
        if (!SMOUser::get($user->id)->is_admin()) return false;
        return true;
    }

    public function update(User $user, SMOUser $smo_user)
    {
        if (!$user->is_smo()) return false;
        $current_user = SMOUser::get($user->id);
        if (!$current_user->is_admin()) return false;
        if ($current_user->attribute->smo_id != $smo_user->attribute->smo_id) return false;
        return true;
    }
}
