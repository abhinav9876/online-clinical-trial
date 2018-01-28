<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PRO extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US');

        $i = 0;
        while ($i < 20) {
            $pro = new \App\PRO([
                'name'          => $faker->company,
                'zip_code'      => $faker->postcode,
                'address'       => $faker->address,
                'address_sup'   => $faker->countryCode,
                'address_notes' => implode($faker->words(rand(1, 5)), ' '),
                'contact'       => $faker->companyEmail
            ]);
            $pro->save();
            $i++;
        }
    }
}
