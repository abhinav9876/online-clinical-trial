<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersEmailDeletedAtUniqueIndex extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unique(['email', 'deleted_at']);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_email_deleted_at_unique');
        });
    }
}
