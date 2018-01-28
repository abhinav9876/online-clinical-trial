<?php

$factory->define(App\Subject::class, function (Faker\Generator $faker) {
    return [
        //'data_id' => 0,
        'post_id' => 0,

        'application_name' => $faker->name(),
        'application_name_furigana' => $faker->name(),
        'application_email' => $faker->unique()->safeEmail,
        'application_tel' => $faker->phoneNumber(),
        'application_calender_1' => date('Y-m-d'),
        'application_calender_2' => date('Y-m-d'),
        'application_calender_3' => date('Y-m-d'),
        'application_time_1' => rand(0, 23),
        'application_time_2' => rand(0, 23),
        'application_time_3' => rand(0, 23),
        'application_by_mail' => rand(0, 1),
        'application_sex' => ['male', 'female'][rand(0, 1)],
        'application_birth' => date('Y-m-d'),
        'application_zip' => rand(0, 1000000),
        'application_address_state' => $faker->address,
        'application_address_city' => $faker->address,
        'application_other' => $faker->sentence(),
        'application_date' => date('Y-m-d h:i:s'),

        'status' => rand(0, 7),
    ];
});
