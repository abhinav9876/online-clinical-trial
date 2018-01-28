<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JMACCT extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'jmaccts';
    public function data()
    {
        return $this->hasOne('App\JMACCTData', 'jmacct_id', 'id');
    }
}
