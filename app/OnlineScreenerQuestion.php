<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineScreenerQuestion extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function online_screener()
    {
        return $this->belongsTo('App\OnlineScreener');
    }
}
