<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminUser extends User
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'users';
    
    static public function get()
    {
        return User::where('type', config('enum.user_type.admin'))->get();
    }
}
