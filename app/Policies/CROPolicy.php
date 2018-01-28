<?php

namespace App\Policies;

use App\User;
use App\CROUser;
use App\CRO;
use Illuminate\Auth\Access\HandlesAuthorization;

class CROPolicy
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

    public function project_index(User $user)
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
        if (!$user->is_cro()) return false;
        if (!CROUser::get($user->id)->is_admin()) return false;
        return true;
    }

    public function billing_update(User $user)
    {
        if (!$user->is_cro()) return false;
        if (!CROUser::get($user->id)->is_admin()) return false;
        return true;
    }
}
