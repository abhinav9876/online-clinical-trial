<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('zip_code')->default('');
            $table->string('address')->default('');
            $table->string('address_sup')->default('');
            $table->string('address_notes')->default('');
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
        Schema::dropIfExists('smos');
    }
}
