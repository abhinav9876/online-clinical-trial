<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->index();
            $table->integer('cro_id')->index();
            $table->string('name')->default('');
            $table->string('protocol')->default('');
            $table->string('drug')->nullable()->index();
            $table->integer('drug_type')->nullable()->index();
            $table->integer('notification_enabled');
            $table->jsonb('notification_email')->default(json_encode('')); // [email(string)]
            $table->integer('maker_id')->nullable();
            $table->integer('category')->index();
            $table->integer('status')->index();
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
        Schema::dropIfExists('projects');
    }
}
