<?php

namespace App\Policies;

use App\User;
use App\PROUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class PROUserPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        if (!$user->is_pro()) return false;
        if (!PROUser::fetch($user->id)->is_admin()) return false;
        return true;
    }

    public function create(User $user)
    {
        if (!$user->is_pro()) return false;
        if (!PROUser::fetch($user->id)->is_admin()) return false;
        return true;
    }

    public function update(User $user, PROUser $pro_user)
    {
        if (!$user->is_pro()) return false;
        $current_user = PROUser::fetch($user->id);
        if (!$current_user->is_admin()) return false;
        if ($current_user->attribute->pro_id != $pro_user->attribute->pro_id) return false;
        return true;
    }
}
