<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToCroAndSmoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cros', function (Blueprint $table) {
            $table->text('contact')->default('');
        });
        Schema::table('smos', function (Blueprint $table) {
            $table->text('contact')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cros', function (Blueprint $table) {
            $table->dropColumn('contact');
        });
        Schema::table('smos', function (Blueprint $table) {
            $table->dropColumn('contact');
        });
    }
}
