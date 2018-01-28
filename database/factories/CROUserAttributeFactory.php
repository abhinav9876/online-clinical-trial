<?php 

$factory->defineAs(App\CROUserAttribute::class, 'admin', function (Faker\Generator $faker) {
    return [
        'user_id' => 0,
        'cro_id' => 0,
        'account_type' => config('enum.cro_user_type.admin'),
        'position' => 'Manager',
    ];
});
$factory->defineAs(App\CROUserAttribute::class, 'member', function (Faker\Generator $faker) {
    return [
        'user_id' => 0,
        'cro_id' => 0,
        'account_type' => config('enum.cro_user_type.member'),
        'position' => 'オペレータ',
    ];
});
