<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @property integer id
 * @property string name
 * @property string zip_code
 * @property string address
 * @property string address_sup
 * @property string address_notes
 * @property string contact
 */
class PRO extends Model
{
    protected $table = 'pros';

    public function update_company(Request $request)
    {
        DB::transaction(function () use ($request) {
            $this->name = $request->name;
            $this->zip_code = $request->zip_code;
            $this->address = $request->address;
            $this->address_sup = $request->address_sup;
            $this->address_notes = $request->address_notes;
            $this->contact = $request->contact;
            $this->save();
        });
    }

    public function member_attributes()
    {
        return PROUserAttribute::with('user')
            ->where('pro_id', $this->id)
            ->where('account_type', config('enum.pro_account_type.member'));
    }
}
