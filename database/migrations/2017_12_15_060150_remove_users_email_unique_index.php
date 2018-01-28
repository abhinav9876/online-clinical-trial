<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUsersEmailUniqueIndex extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_email_unique');
        });
    }

    public function down()
    {
        /* If this error because of duplicate data, remove the offending data from the database */
        Schema::table('users', function (Blueprint $table) {
            $table->unique('email');
        });
    }
}
