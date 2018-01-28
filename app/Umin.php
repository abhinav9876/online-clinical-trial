<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Umin extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'umins';
    public function data()
    {
        return $this->hasOne('App\UminData', 'umin_id', 'id');
    }
}
