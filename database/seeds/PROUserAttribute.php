<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PROUserAttribute extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US');

        $PRO_idx = App\PRO::all()->pluck('id')->toArray();
        $pro_account_types = array_values(config('enum.pro_account_type'));

        $i = 0;
        while ($i < 20) {
            $pro_user_attr = new \App\PROUserAttribute([
                'user_id'      => factory(App\User::class, 'pro')->create()->id,
                'pro_id'       => array_rand($PRO_idx),
                'account_type' => array_rand($pro_account_types),
                'position'     => $faker->jobTitle
            ]);
            $pro_user_attr->save();
            $i++;
        }
    }
}
