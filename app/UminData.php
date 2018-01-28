<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UminData extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'umin_data';
    public function umin()
    {
        return $this->belongsTo('App\Umin');
    }
}
