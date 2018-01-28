<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DebugAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 'admin')->create([
            'name' => 'Puzz Admin 1',
            'email' => 'admin@example.com',
        ]);
        factory(App\User::class, 'admin')->create([
            'name' => 'Puzz Admin 2',
            'email' => 'admin2@example.com',
        ]);
    }
}
