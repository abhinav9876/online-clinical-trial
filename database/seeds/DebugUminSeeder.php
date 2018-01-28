<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DebugUminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Umin::class, 10)
            ->create()
            ->each(function ($u) {
                factory(App\UminData::class)->create([
                    'umin_id' => $u->id,
                ]);
            });
    }
}
