<?php 

$factory->defineAs(App\SMOUserAttribute::class, 'admin', function (Faker\Generator $faker) {
    return [
        'user_id' => 0,
        'smo_id' => 0,
        'account_type' => config('enum.smo_user_type.admin'),
        'position' => 'Manager',
    ];
});
$factory->defineAs(App\SMOUserAttribute::class, 'member', function (Faker\Generator $faker) {
    return [
        'user_id' => 0,
        'smo_id' => 0,
        'account_type' => config('enum.smo_user_type.member'),
        'position' => 'オペレータ',
    ];
});
