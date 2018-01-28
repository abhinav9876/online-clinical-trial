<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProUserAttributes extends Migration
{
    public function up()
    {
        Schema::create('pro_user_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('pro_id')->index();
            $table->integer('account_type')->index();
            $table->string('position')->default('');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pro_user_attributes');
    }
}
