<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMO extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'smos';
    public function user_attributes()
    {
        return $this->hasMany('App\SMOUserAttribute', 'smo_id', 'id');
    }
    public function admin_user()
    {
        return SMOUserAttribute::where('smo_id', $this->id)
        ->where('account_type', config('enum.smo_user_type.admin'))
        ->first()->user;
    }
    public function member_attributes()
    {
        return SMOUserAttribute::with('user')
        ->where('smo_id', $this->id)
        ->where('account_type', config('enum.smo_user_type.member'));
    }

    public function address_display()
    {
        return $this->address . ' ' . $this->address_sup;
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
    
    static public function form_create(Request $request)
    {
        \DB::transaction(function() use ($request) {
            $smo = new SMO;
            $smo->name = $request->name;
            $smo->zip_code = $request->zip_code;
            $smo->address = $request->address;
            $smo->address_sup = $request->address_sup;
            $smo->address_notes = $request->address_notes;
            $smo->save();
            
            $user = new SMOUser;
            $user->name = $request->admin_name;
            $user->email = $request->admin_email;
            $user->type = config('enum.user_type.smo');
            $user->password = bcrypt($request->password);
            $user->save();
            
            $user_attribute = new SMOUserAttribute;
            $user_attribute->user_id = $user->id;
            $user_attribute->smo_id = $smo->id;
            $user_attribute->account_type = config('enum.smo_user_type.admin');
            $user_attribute->save();
        });
    }
    static public function form_update($id, Request $request)
    {
        $smo = SMO::find($id);
        $admin = $smo->admin_user();
        $admin_attribute = $admin->attribute;
        
        if ($request->action == config('enum.form_action.save')) {
            \DB::transaction(function() use ($request, $smo, $admin) {
                $smo->name = $request->name;
                $smo->zip_code = $request->zip_code;
                $smo->address = $request->address;
                $smo->address_sup = $request->address_sup;
                $smo->address_notes = $request->address_notes;
                $smo->save();
                
                $admin->name = $request->admin_name;
                $admin->email = $request->admin_email;
                if ($request->password != '') {
                    $admin->password = bcrypt($request->password);
                }
                $admin->save();
            });
        } else if ($request->action == config('enum.form_action.delete')) {
            \DB::transaction(function() use ($request, $smo, $admin, $admin_attribute) {
                $admin_attribute->delete();

                $member_attributes = $smo->member_attributes()->get();
                foreach ($member_attributes as $member_attr) {
                    $member_attr->user->delete();
                    $member_attr->delete();
                }

                $admin->delete();
                $smo->delete();
            });
        } else {
            // todo: handle error
        }
    }
}
