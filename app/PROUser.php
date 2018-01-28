<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Lang;

/**
 * @property PROUserAttribute attribute
 * @property PRO pro
 */
class PROUser extends User
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'users';

    public function attribute()
    {
        return $this->hasOne('App\PROUserAttribute', 'user_id');
    }

    public function pro()
    {
        return $this->attribute->pro;
    }

    public function is_admin()
    {
        return $this->attribute->account_type == config('enum.pro_account_type.admin');
    }

    public function account_type_display()
    {
        return Lang::get('pro/shared.account_type')[$this->attribute->account_type];
    }

    public function update_profile($request)
    {
        DB::transaction(function () use ($request) {
            $this->name = $request->name;
            $this->email = $request->email;

            if (isset($request->password)) {
                $this->password = bcrypt($request->password);
            }

            $this->save();
            $this->attribute->position = $request->position;
            $this->attribute->save();
        });
    }

    static public function list()
    {
//        return PROUser::where('type', config('enum.user_type.smo'))->paginate(env('LIST_ITEMS_PER_PAGE'));
    }

    /**
     * @param $id
     * @return PROUser
     */
    static public function fetch($id)
    {
        return self::where('type', config('enum.user_type.pro'))->where('id', $id)->get()->first();
    }

    static public function form_create_member(Request $request)
    {
        $pro_user = PROUser::fetch(Auth::id());
        $pro = $pro_user->attribute->pro;

        DB::transaction(function () use ($request, $pro) {
            $user = new PROUser;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->type = config('enum.user_type.pro');
            $user->password = bcrypt($request->password);
            $user->save();

            $user_attribute = new PROUserAttribute;
            $user_attribute->user_id = $user->id;
            $user_attribute->pro_id = $pro->id;
            $user_attribute->position = $request->position;
            $user_attribute->account_type = config('enum.pro_account_type.member');
            $user_attribute->save();
        });
    }

    static public function form_update_member($id, Request $request)
    {
        $pro_user = PROUser::fetch($id);
        $pro_user_attribute = $pro_user->attribute;

        if ($request->action == config('enum.form_action.save')) {
            DB::transaction(function () use ($request, $pro_user, $pro_user_attribute) {
                $pro_user->name = $request->name;
                $pro_user->email = $request->email;
                $pro_user->status = intval($request->status);
                if ($request->password != '') {
                    $pro_user->password = bcrypt($request->password);
                }
                $pro_user->save();
                $pro_user_attribute->position = $request->position;
                $pro_user_attribute->save();
            });
        } else if ($request->action == config('enum.form_action.delete')) {
            DB::transaction(function () use ($request, $pro_user, $pro_user_attribute) {
                $pro_user->delete();
                $pro_user_attribute->delete();
            });
        } else {
            throw new \Exception('Unexpected action');
        }
    }
}
