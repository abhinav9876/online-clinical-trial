<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('smo_id')->index();
            $table->integer('project_id')->index();
            $table->string('title')->default('');
            $table->text('description')->default('');
            $table->text('selection_criteria')->default('');
            $table->text('exclusion_criteria')->default('');
            $table->text('participation_benefits')->default('');
            $table->text('exam_day_notes')->default('');
            $table->string('facility_name')->default('');
            $table->dateTime('start_recruitment_at')->nullable();
            $table->dateTime('end_recruitment_at')->nullable();
            $table->integer('required_no_scr')->default(0);
            $table->string('crc_name')->default('');
            $table->string('crc_email')->default('')->index();
            $table->jsonb('exam_schedule_items')->default(json_encode('')); // [label => string, conduct_at => datetime]
            $table->jsonb('reward_items')->default(json_encode('')); // [label => string, reward => string]
            $table->string('facility_zip_code')->default('');
            $table->string('facility_address')->default('');
            $table->string('facility_address_sup')->default('');
            $table->string('facility_address_notes')->default('');
            $table->string('status')->default('published');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
