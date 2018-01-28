<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DebugCROSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Debug User
        $user = factory(App\User::class, 'cro')->create([
            'email' => 'cro@example.com',
          ]);
        $cro = factory(App\CRO::class, 'cro')->create();
        factory(App\CROUserAttribute::class, 'admin')->create([
            'user_id' => $user->id,
            'cro_id' => $cro->id,
        ]);
        for ($i = 0; $i < 3; $i++) {
            $member = factory(App\User::class, 'cro')->create();
            factory(App\CROUserAttribute::class, 'member')->create([
                'user_id' => $member->id,
                'cro_id' => $cro->id,
            ]);
        }
        factory(App\CROBilling::class)->create([
            'cro_id' => $cro->id,
        ]);
        for ($i = 0; $i < 3; $i++) {
            $project = factory(App\Project::class, 'cro')->create([
                'cro_id' => $cro->id,
                'owner_id' => $user->id,
                'maker_id' => null,
            ]);
            factory(App\OnlineScreener::class)->create([
                'project_id' => $project->id,
            ]);
        }
        $oscrs = App\OnlineScreener::select('id')->get();
        foreach ($oscrs as $oscr) {
            factory(App\OnlineScreenerQuestion::class, 'dropdown')->create([
                'online_screener_id' => $oscr->id,
            ]);
            factory(App\OnlineScreenerQuestion::class, 'checkbox')->create([
                'online_screener_id' => $oscr->id,
            ]);
            factory(App\OnlineScreenerQuestion::class, 'freetext')->create([
                'online_screener_id' => $oscr->id,
            ]);
            factory(App\OnlineScreenerQuestion::class, 'matrix')->create([
                'online_screener_id' => $oscr->id,
            ]);
        }

        // Random User
        for ($i = 0; $i < 5; $i++) {
            $cro = factory(App\CRO::class, 'cro')->create();
            factory(App\CROUserAttribute::class, 'admin')->create([
                'user_id' => factory(App\User::class, 'cro')->create()->id,
                'cro_id' => $cro->id,
            ]);
            for ($j = 0; $j < 3; $j++) {
                $user = factory(App\User::class, 'cro')->create();
                factory(App\CROUserAttribute::class, 'member')->create([
                    'user_id' => $user->id,
                    'cro_id' => $cro->id,
                ]);
            }
            factory(App\CROBilling::class)->create([
                'cro_id' => $cro->id,
            ]);
        }
        for ($i = 0; $i < 5; $i++) {
            $maker = factory(App\CRO::class, 'maker')->create();
            factory(App\CROUserAttribute::class, 'admin')->create([
                'user_id' => factory(App\User::class, 'cro')->create()->id,
                'cro_id' => $maker->id,
            ]);
            for ($j = 0; $j < 3; $j++) {
                factory(App\CROUserAttribute::class, 'member')->create([
                    'user_id' => factory(App\User::class, 'cro')->create()->id,
                    'cro_id' => $maker->id,
                ]);
            }
            factory(App\CROBilling::class)->create([
                'cro_id' => $maker->id,
            ]);
        }
    }
}
