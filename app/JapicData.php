<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JapicData extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'japic_data';
    public function japic()
    {
        return $this->belongsTo('App\Japic');
    }
}
