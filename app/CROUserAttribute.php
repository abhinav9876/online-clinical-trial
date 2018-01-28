<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CROUserAttribute extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'cro_user_attributes';
    
    public function user()
    {
        return $this->belongsTo('App\CROUser');
    }
    public function cro()
    {
        return $this->belongsTo('App\CRO');
    }
}
