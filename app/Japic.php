<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Japic extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'japics';
    public function data()
    {
        return $this->hasOne('App\JapicData', 'japic_id', 'id');
    }
}
