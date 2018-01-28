<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\MailResetPasswordToken;

/**
 * @property integer id
 * @property string name
 * @property string email
 * @property string password
 * @property integer type
 * @property integer status
 */
class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    public function is_admin()
    {
        return $this->type == config('enum.user_type.admin');
    }
    public function is_smo()
    {
        return $this->type == config('enum.user_type.smo');
    }
    public function is_cro()
    {
        return $this->type == config('enum.user_type.cro');
    }

    public function is_pro()
    {
        return $this->type == config('enum.user_type.pro');
    }

    public function status_display()
    {
        $s = $this->status;
        $type_displays = [
            config('enum.user_status.inactive') => __('model.user_status.inactive'),
            config('enum.user_status.active')   => __('model.user_status.active'),
        ];
        return $type_displays[$s];
    }
}
