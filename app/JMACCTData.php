<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JMACCTData extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'jmacct_data';
    public function jmacct()
    {
        return $this->belongsTo('App\JMACCT');
    }
}
