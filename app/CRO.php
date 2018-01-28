<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;

class CRO extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'cros';

    public function type_display()
    {
        $type_displays = [
            __('model.cro_type.cro'),
            __('model.cro_type.maker'),
        ];
        return $type_displays[$this->type];
    }

    public function user_attributes()
    {
        return $this->hasMany('App\CROUserAttribute', 'cro_id', 'id');
    }

    public function projects()
    {
        return $this->hasMany('App\Project', 'cro_id', 'id');
    }

    public function billing()
    {
        return $this->hasOne('App\CROBilling', 'cro_id', 'id');
    }

    public function admin_user()
    {
        return CROUserAttribute::where('cro_id', $this->id)
            ->where('account_type', config('enum.cro_user_type.admin'))
            ->first()->user;
    }

    public function member_attributes()
    {
        return CROUserAttribute::with('user')
            ->where('cro_id', $this->id)
            ->where('account_type', config('enum.cro_user_type.member'));
    }

    public function address_display()
    {
        return $this->address . ' ' . $this->address_sup;
    }

    public static function makers()
    {
        return CRO::where('type', config('enum.cro_type.maker'))->get();
    }

    public function update_company(Request $request)
    {
        \DB::transaction(function() use ($request) {
            $this->name = $request->name;
            $this->zip_code = $request->zip_code;
            $this->address = $request->address;
            $this->address_sup = $request->address_sup;
            $this->address_notes = $request->address_notes;
            $this->contact = $request->contact;
            $this->save();
        });
    }

    public function update_billing(Request $request)
    {
        \DB::transaction(function() use ($request) {
            $this->billing->company = $request->company;
            $this->billing->person = $request->person;
            $this->billing->zip_code = $request->zip_code;
            $this->billing->address = $request->address;
            $this->billing->address_sup = $request->address_sup;
            $this->billing->address_notes = $request->address_notes;
            $this->billing->contact = $request->contact;
            $this->billing->save();
        });
    }

    static public function form_create(Request $request)
    {
        \DB::transaction(function() use ($request) {
            $cro = new CRO;
            $cro->name = $request->name;
            if ($request->group_type == 'cro') {
                $cro->type = config('enum.cro_type.cro');
            } else if ($request->group_type == 'maker') {
                $cro->type = config('enum.cro_type.maker');
            } else {
                // todo: handle error
            }
            $cro->zip_code = $request->zip_code;
            $cro->address = $request->address;
            $cro->address_sup = $request->address_sup;
            $cro->address_notes = $request->address_notes;
            $cro->save();

            $billing = new CROBilling;
            $billing->cro_id = $cro->id;
            $billing->company = $request->name;
            $billing->person = $request->admin_name;
            $billing->address = '';
            $billing->contact = '';
            $billing->save();

            $user = new CROUser;
            $user->name = $request->admin_name;
            $user->email = $request->admin_email;
            $user->type = config('enum.user_type.cro');
            $user->password = bcrypt($request->password);
            $user->save();

            $user_attribute = new CROUserAttribute;
            $user_attribute->user_id = $user->id;
            $user_attribute->cro_id = $cro->id;
            $user_attribute->account_type = config('enum.cro_user_type.admin');
            $user_attribute->save();
        });
    }

    static public function form_update($id, Request $request)
    {
        $cro = CRO::find($id);
        $admin = $cro->admin_user();
        $admin_attribute = $admin->attribute;

        if ($request->action == config('enum.form_action.save')) {
            \DB::transaction(function() use ($request, $cro, $admin) {
                $cro->name = $request->name;
                if ($request->group_type == 'cro') {
                    $cro->type = config('enum.cro_type.cro');
                } else if ($request->group_type == 'maker') {
                    $cro->type = config('enum.cro_type.maker');
                } else {
                    // todo: handle error
                }
                $cro->zip_code = $request->zip_code;
                $cro->address = $request->address;
                $cro->address_sup = $request->address_sup;
                $cro->address_notes = $request->address_notes;
                $cro->save();

                $admin->name = $request->admin_name;
                $admin->email = $request->admin_email;
                if ($request->password != '') {
                    $admin->password = bcrypt($request->password);
                }
                $admin->save();
            });
        } else if ($request->action == config('enum.form_action.delete')) {
            \DB::transaction(function() use ($request, $cro, $admin, $admin_attribute) {
                $admin_attribute->delete();
                $admin->delete();

                $member_attributes = $cro->member_attributes()->get();
                foreach ($member_attributes as $member_attr) {
                    $member_attr->user->delete();
                    $member_attr->delete();
                }

                $cro->delete();
            });
        } else {
            // todo: handle error
        }
    }

    static public function debug_request(Request $request)
    {
        $password_confirmation = $request->password_confirmation;
        Log::info('[Request debug start]');
        Log::info('request: '.$request);
        Log::info('action: '.$request->action);
        Log::info('name: '.$request->name);
        Log::info('group_type: '.$request->group_type);
        Log::info('group_admin_name: '.$request->admin_name);
        Log::info('email: '.$request->admin_email);
        Log::info('password: '.$request->password);
        Log::info('password_confirmation: '.$request->password_confirmation);
    }
}
