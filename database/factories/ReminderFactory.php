<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reminder::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'reminder_date' => $faker->date('Y-m-d'),
        'repeat' => 'monthly',
        'user_id' => 1,
        'type' => $faker->randomElement(['event', 'bill', 'birthday', 'meeting']),
        'is_active' => 1,
    ];
});
