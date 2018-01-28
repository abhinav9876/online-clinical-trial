<?php

$factory->define(App\SMO::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'zip_code' => $faker->postcode,
        'address' => $faker->address,
        'address_sup' => '2-chome',
        'address_notes' => $faker->sentence(),
        'contact' => $faker->phoneNumber(),
    ];
});
