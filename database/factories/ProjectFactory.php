<?php

$factory->defineAs(App\Project::class, 'cro', function (Faker\Generator $faker) {
    return [
        'cro_id' => 0,
        'owner_id' => 0,
        'name' => $faker->name,
        'protocol' => str_random(10),
        'drug' => 'C000000001',
        'drug_type' => rand(0, 2),
        'notification_enabled'=> rand(0, 1),
        'notification_email' => json_encode([
            $faker->unique()->safeEmail,
            $faker->unique()->safeEmail,
            $faker->unique()->safeEmail,
        ]),
        'maker_id' => 0,
        'category' => rand(0, 5),
        'status' => rand(0, 2),
    ];
});

$factory->defineAs(App\Project::class, 'maker', function (Faker\Generator $faker) {
    return [
        'cro_id' => 0,
        'owner_id' => 0,
        'name' => $faker->name,
        'protocol' => str_random(10),
        'drug' => 'C000000001',
        'drug_type' => rand(0, 2),
        'notification_enabled'=> rand(0, 1),
        'notification_email' => json_encode([
            $faker->unique()->safeEmail,
            $faker->unique()->safeEmail,
            $faker->unique()->safeEmail,
        ]),
        'maker_id' => null,
        'category' => rand(0, 5),
        'status' => rand(0, 2),
    ];
});
