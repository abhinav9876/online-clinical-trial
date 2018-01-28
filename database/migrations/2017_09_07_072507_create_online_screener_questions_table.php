<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineScreenerQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_screener_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('online_screener_id')->index();
            $table->text('text');
            $table->integer('answer_type')->index();
            $table->jsonb('dropdown_values')->nullable();
            $table->jsonb('checkbox_values')->nullable();
            
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
        Schema::dropIfExists('online_screener_questions');
    }
}
