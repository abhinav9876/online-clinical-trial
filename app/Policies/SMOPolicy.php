<?php

namespace App\Policies;

use App\User;
use App\SMOUser;
use App\SMO;
use Illuminate\Auth\Access\HandlesAuthorization;

class SMOPolicy
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
        return $user->is_admin();
    }

    public function create(User $user)
    {
        return $user->is_admin();
    }

    public function update(User $user)
    {
        return $user->is_admin();
    }

    public function company_update(User $user)
    {
        if (!$user->is_smo()) return false;
        if (!SMOUser::get($user->id)->is_admin()) return false;
        return true;
    }
}
