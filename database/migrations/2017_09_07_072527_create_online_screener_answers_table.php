<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineScreenerAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_screener_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id')->index();
            $table->integer('online_screener_question_id')->index();
            $table->jsonb('dropdown_selected')->nullable();
            $table->jsonb('checkbox_selected')->nullable();
            $table->text('freetext')->nullable();
            $table->jsonb('matrix_question_values_selected')->nullable();
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
        Schema::dropIfExists('online_screener_answers');
    }
}
