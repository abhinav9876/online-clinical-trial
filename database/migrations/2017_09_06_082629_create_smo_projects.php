<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmoProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smo_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('smo_id')->index();
            $table->integer('project_id')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['smo_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smo_projects');
    }
}
