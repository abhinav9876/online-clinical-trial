<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmtApplicationScreenerDb extends Migration
{
    public function up()
    {
        Schema::create('smt_application_screener_db', function (Blueprint $table) {
            $table->increments('application_screener_1');
            $table->integer('application_id')->index();
            $table->integer('screener_id')->index();
            $table->string('screener_answers');
            $table->dateTime('application_screener_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('smt_application_screener_db');
    }
}
