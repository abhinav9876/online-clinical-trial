<?php

$factory->defineAs(App\CRO::class, 'cro', function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'type' => config('enum.cro_type.cro'),
        'zip_code' => $faker->postcode,
        'address' => $faker->address,
        'address_sup' => '2-chome',
        'address_notes' => $faker->sentence(),
        'contact' => $faker->phoneNumber(),
    ];
});

$factory->defineAs(App\CRO::class, 'maker', function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'type' => config('enum.cro_type.maker'),
        'zip_code' => $faker->postcode,
        'address' => $faker->address,
        'address_sup' => '2-chome',
        'address_notes' => $faker->sentence(),
        'contact' => $faker->phoneNumber(),
    ];
});
