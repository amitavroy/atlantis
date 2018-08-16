<?php

use Faker\Generator as Faker;
use App\Task;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'family_id' => 1,
        'description' => $faker->sentence,
        'user_id' => 1,
        'is_complete' => $faker->randomElement([0,1]),
    ];
});
