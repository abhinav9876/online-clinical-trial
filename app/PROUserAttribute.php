<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int account_type
 * @property int pro_id
 * @property int user_id
 * @property string position
 * @property PRO pro
 */
class PROUserAttribute extends Model
{
    protected $table = 'pro_user_attributes';

    public function user()
    {
        return $this->belongsTo('App\PROUser');
    }

    public function pro()
    {
        return $this->belongsTo('App\PRO');
    }
}
