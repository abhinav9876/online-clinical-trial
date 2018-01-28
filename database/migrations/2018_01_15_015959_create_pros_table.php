<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProsTable extends Migration
{
    public function up()
    {
        Schema::create('pros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('zip_code')->default('');
            $table->string('address')->default('');
            $table->string('address_sup')->default('');
            $table->string('address_notes')->default('');
            $table->text('contact')->default('');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pros');
    }
}
