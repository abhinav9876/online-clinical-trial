<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('umin_id')->nullable()->index();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('owner')->nullable();
            $table->string('status')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('umins');
    }
}
