<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNgValuesToOnlineScreenerQuestions extends Migration
{
    public function up()
    {
        Schema::table('online_screener_questions', function (Blueprint $table) {
            $table->jsonb('ng_values')->nullable();
        });
    }

    public function down()
    {
        Schema::table('online_screener_questions', function (Blueprint $table) {
            $table->dropColumn('ng_values');
        });
    }
}
