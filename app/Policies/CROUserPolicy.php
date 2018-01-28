<?php

namespace App\Policies;

use App\User;
use App\CROUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class CROUserPolicy
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
        if (!$user->is_cro()) return false;
        if (!CROUser::get($user->id)->is_admin()) return false;
        return true;
    }

    public function create(User $user)
    {
        if (!$user->is_cro()) return false;
        if (!CROUser::get($user->id)->is_admin()) return false;
        return true;
    }

    public function update(User $user, CROUser $cro_user)
    {
        if (!$user->is_cro()) return false;
        $current_user = CROUser::get($user->id);
        if (!$current_user->is_admin()) return false;
        if ($current_user->attribute->cro_id != $cro_user->attribute->cro_id) return false;
        return true;
    }
}
