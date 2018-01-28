<?php

$factory->define(App\CROBilling::class, function (Faker\Generator $faker) {
    return [
        'cro_id' => 0,
        'company' => $faker->name(),
        'person' => $faker->name(),
        'zip_code' => $faker->postcode,
        'address' => $faker->address,
        'address_sup' => '2-chome',
        'address_notes' => $faker->sentence(),
        'contact' => $faker->phoneNumber(),
    ];
});
