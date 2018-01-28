<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMOUserAttribute extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'smo_user_attributes';
    public function user()
    {
        return $this->belongsTo('App\SMOUser');
    }
    public function smo()
    {
        return $this->belongsTo('App\SMO');
    }
}
