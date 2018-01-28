<?php

$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'type' => config('enum.user_type.admin'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'cro', function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'type' => config('enum.user_type.cro'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'smo', function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'type' => config('enum.user_type.smo'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'pro', function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'type' => config('enum.user_type.pro'),
        'remember_token' => str_random(10),
    ];
});
