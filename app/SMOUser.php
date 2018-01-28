<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMOUser extends User
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'users';

    public function attribute()
    {
        return $this->hasOne('App\SMOUserAttribute', 'user_id');
    }

    public function smo()
    {
        return $this->attribute->smo;
    }

    public function is_admin()
    {
        return $this->attribute->account_type == config('enum.smo_user_type.admin');
    }

    public function account_type_display()
    {
        $t = $this->attribute->account_type;
        $type_displays = [
            'Manager',
            'メンバー',
        ];
        return $type_displays[$t];
    }

    public function update_profile($request)
    {
        \DB::transaction(function() use ($request) {
            $this->name = $request->name;
            $this->email = $request->email;
            if ($request->password != '') {
                $this->password = bcrypt($request->password);
            }
            $this->save();

            $this->attribute->position = $request->position;
            $this->attribute->save();
        });
    }

    static public function list()
    {
        return SMOUser::where('type', config('enum.user_type.smo'))->paginate(env('LIST_ITEMS_PER_PAGE'));
    }
    static public function get($id)
    {
        return SMOUser::where('type', config('enum.user_type.smo'))
        ->where('id', $id)
        ->get()
        ->first();
    }

    static public function form_create_member(Request $request)
    {
        $user = SMOUser::get(Auth::id());
        $smo = $user->attribute->smo;
        \DB::transaction(function() use ($request, $smo) {
            $user = new SMOUser;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->type = config('enum.user_type.smo');
            $user->password = bcrypt($request->password);
            $user->save();

            $user_attribute = new SMOUserAttribute;
            $user_attribute->user_id = $user->id;
            $user_attribute->smo_id = $smo->id;
            $user_attribute->position = $request->position;
            $user_attribute->account_type = config('enum.smo_user_type.member');
            $user_attribute->save();
        });
    }

    static public function form_update_member($id, Request $request)
    {
        $user = SMOUser::get($id);
        $user_attribute = $user->attribute;

        if ($request->action == config('enum.form_action.save')) {
            \DB::transaction(function() use ($request, $user, $user_attribute) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->status = intval($request->status);
                if ($request->password != '') {
                    $user->password = bcrypt($request->password);
                }
                $user->save();

                $user_attribute->position = $request->position;
                $user_attribute->save();
            });
        } else if ($request->action == config('enum.form_action.delete')) {
            \DB::transaction(function() use ($request, $user, $user_attribute) {
                $user->delete();
                $user_attribute->delete();
            });
        } else {
            // todo: handle error
        }
    }
}
