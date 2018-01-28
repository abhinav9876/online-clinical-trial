<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->integer('type')->index();
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
        Schema::dropIfExists('cros');
    }
}
