<?php

$factory->define(App\OnlineScreener::class, function (Faker\Generator $faker) {
    return [
        'project_id' => 0,
    ];
});

$factory->defineAs(App\OnlineScreenerQuestion::class, 'dropdown', function (Faker\Generator $faker) {
    return [
        'online_screener_id' => 0,
        'text' => 'dropdownから選んで下さい',
        'answer_type' => config('enum.online_screening_answer_type.dropdown'),
        'dropdown_values' => json_encode([
            $faker->name,
            $faker->name,
            $faker->name,
            $faker->name,
        ]),
        'checkbox_values' => null,
        'matrix_question_values' => null,
    ];
});
$factory->defineAs(App\OnlineScreenerQuestion::class, 'checkbox', function (Faker\Generator $faker) {
    return [
        'online_screener_id' => 0,
        'text' => 'checkboxから選んで下さい（複数選択可）',
        'answer_type' => config('enum.online_screening_answer_type.checkbox'),
        'dropdown_values' => null,
        'checkbox_values' => json_encode([
            $faker->name,
            $faker->name,
            $faker->name,
            $faker->name,
        ]),
        'matrix_question_values' => null,
    ];
});
$factory->defineAs(App\OnlineScreenerQuestion::class, 'freetext', function (Faker\Generator $faker) {
    return [
        'online_screener_id' => 0,
        'text' => '自由Reply',
        'answer_type' => config('enum.online_screening_answer_type.freetext'),
        'dropdown_values' => null,
        'checkbox_values' => null,
        'matrix_question_values' => null,
    ];
});
//matrix start
$factory->defineAs(App\OnlineScreenerQuestion::class, 'matrix', function (Faker\Generator $faker) {
    return [
        'online_screener_id' => 0,
        'text' => 'please select your option',
        'answer_type' => config('enum.online_screening_answer_type.matrix'),
        'dropdown_values' => null,
        'checkbox_values' => null,
        'matrix_question_values' => json_encode([
            $faker->name,
            $faker->name,
            $faker->name,
            $faker->name,
        ]),
    ];
});
//matrix end

$factory->defineAs(App\OnlineScreenerAnswer::class, 'dropdown', function (Faker\Generator $faker) {
    return [
        'subject_id' => 0,
        'online_screener_question_id' => 0,
        'dropdown_selected' => json_encode([
            'dropdown選択肢1'
        ]),
        'checkbox_selected' => null,
        'freetext' => '',
    ];
});
$factory->defineAs(App\OnlineScreenerAnswer::class, 'checkbox', function (Faker\Generator $faker) {
    return [
        'subject_id' => 0,
        'online_screener_question_id' => 0,
        'dropdown_selected' => null,
        'checkbox_selected' => json_encode([
            'checkbox選択肢1',
            'checkbox選択肢4',
            'checkbox選択肢7',
        ]),
        'freetext' => '',
    ];
});
$factory->defineAs(App\OnlineScreenerAnswer::class, 'freetext', function (Faker\Generator $faker) {
    return [
        'subject_id' => 0,
        'online_screener_question_id' => 0,
        'dropdown_selected' => null,
        'checkbox_selected' => null,
        'freetext' => '自由記述Replyテキスト',
    ];
});
$factory->defineAs(App\OnlineScreenerAnswer::class, 'matrix', function (Faker\Generator $faker) {
    return [
        'subject_id' => 0,
        'online_screener_question_id' => 0,
        'dropdown_selected' => null,
        'matrix_selected' => json_encode([
            'matrix1',
            'matrix4',
            'matrix7',
        ]),
        'freetext' => '',
    ];
});
