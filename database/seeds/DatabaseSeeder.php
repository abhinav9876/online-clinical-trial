<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->truncate();
        DB::table('users')->truncate();
        DB::table('password_resets')->truncate();

        DB::table('smt_application_db')->truncate(); // subjects
        //DB::table('umins')->truncate();
        //DB::table('umin_data')->truncate();
        //DB::table('japics')->truncate();
        //DB::table('japic_data')->truncate();
        //DB::table('jmaccts')->truncate();
        //DB::table('jmacct_data')->truncate();

        DB::table('cros')->truncate();
        DB::table('cro_user_attributes')->truncate();
        DB::table('cro_billings')->truncate();
        DB::table('smo_projects')->truncate();
        DB::table('projects')->truncate();

        DB::table('online_screeners')->truncate();
        DB::table('online_screener_questions')->truncate();
        DB::table('online_screener_answers')->truncate();

        DB::table('smos')->truncate();
        DB::table('smo_user_attributes')->truncate();

        DB::table('pro_projects')->truncate();
        DB::table('pro_user_attributes')->truncate();
        DB::table('pros')->truncate();

        $this->call(DebugAdminSeeder::class);
        $this->call(DebugCROSeeder::class);
        $this->call(DebugSMOSeeder::class);
        $this->call(DebugSMOProjectSeeder::class);
        $this->call(DebugPostSeeder::class);
        $this->call(DebugSubjectSeeder::class);
        //$this->call(DebugUminSeeder::class);

        $this->call(PRO::class);
        $this->call(PROUserAttribute::class);
    }
}
