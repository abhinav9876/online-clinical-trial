<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('online_screener_questions', function (Blueprint $table) {
            //
             $table->jsonb('matrix_question_values')->nullable();
        });
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
    {
        Schema::table('online_screener_questions', function (Blueprint $table) {
            //
																			$table->dropColumn('matrix_question_values');
        });
    }
}
