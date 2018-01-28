<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DebugSMOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Debug User
        $user = factory(App\User::class, 'smo')->create([
            'email' => 'smo@example.com',
          ]);
        $smo = factory(App\SMO::class)->create();
        factory(App\SMOUserAttribute::class, 'admin')->create([
            'user_id' => $user->id,
            'smo_id' => $smo->id,
        ]);
        for ($i = 0; $i < 3; $i++) {
            $user = factory(App\User::class, 'smo')->create();
            factory(App\SMOUserAttribute::class, 'member')->create([
                'user_id' => $user->id,
                'smo_id' => $smo->id,
            ]);
        }

        // Random User
        for ($i = 0; $i < 5; $i++) {
            $smo = factory(App\SMO::class)->create();
            factory(App\SMOUserAttribute::class, 'admin')->create([
                'user_id' => factory(App\User::class, 'smo')->create()->id,
                'smo_id' => $smo->id,
            ]);
            for ($j = 0; $j < 3; $j++) {
                $user = factory(App\User::class, 'smo')->create();
                factory(App\SMOUserAttribute::class, 'member')->create([
                    'user_id' => $user->id,
                    'smo_id' => $smo->id,
                ]);
            }
        }
    }
}
