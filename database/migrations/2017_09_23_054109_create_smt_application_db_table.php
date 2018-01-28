<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmtApplicationDbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smt_application_db', function (Blueprint $table) {
            $table->increments('application_id');

            //$table->integer('data_id');
            $table->integer('post_id')->index();
            
            $table->string('application_name');
            $table->string('application_name_furigana');
            $table->string('application_email');
            $table->string('application_tel');
            $table->date('application_calender_1');
            $table->date('application_calender_2');
            $table->date('application_calender_3');
            $table->integer('application_time_1');
            $table->integer('application_time_2');
            $table->integer('application_time_3');
            $table->integer('application_by_mail');
            $table->string('application_sex');
            $table->date('application_birth');
            $table->integer('application_zip');
            $table->string('application_address_state');
            $table->string('application_address_city');
            $table->text('application_other');
            $table->dateTime('application_date');

            $table->integer('status')->index();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smt_application_db');
    }
}
