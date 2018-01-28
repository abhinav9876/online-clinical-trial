<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCroBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cro_billings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cro_id')->index();
            $table->string('company')->default('');
            $table->string('person')->default('');
            $table->string('zip_code')->default('');
            $table->string('address')->default('');
            $table->string('address_sup')->default('');
            $table->string('address_notes')->default('');
            $table->text('contact')->default('');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['cro_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cro_billings');
    }
}
