<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenderAgeColumnsToPosts extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('required_subject_gender')->default(config('enum.post_gender_conditions.any'));
            $table->integer('minimum_subject_age')->default(0);
            $table->integer('maximum_subject_age')->default(0);
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('required_subject_gender');
            $table->dropColumn('minimum_subject_age');
            $table->dropColumn('maximum_subject_age');
        });
    }
}
