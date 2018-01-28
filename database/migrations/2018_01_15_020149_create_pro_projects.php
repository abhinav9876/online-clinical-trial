<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProProjects extends Migration
{
    public function up()
    {
        Schema::create('pro_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id')->index();
            $table->integer('project_id')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['pro_id', 'project_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pro_projects');
    }
}
