<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineScreenerAnswer extends Model
{
    protected $connection = 'smt_mysql';
    protected $table      = 'smt_application_screener_db';

    public function online_screener_question()
    {
        return $this->belongsTo('App\OnlineScreenerQuestion');
    }
}
