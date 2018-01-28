<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CROBilling extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'cro_billings';
    public function cro()
    {
        return $this->belongsTo('App\CRO');
    }
}
