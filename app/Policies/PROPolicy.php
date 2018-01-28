<?php

namespace App\Policies;

use App\User;
use App\PROUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class PROPolicy
{
    use HandlesAuthorization;

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
        Log::debug('Authenticating PRO user(' . $user->id . ') for company update..');
        return $user->is_pro() && PROUser::fetch($user->id)->is_admin();
    }
}
