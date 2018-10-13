<?php

use Faker\Generator as Faker;

$factory->define(App\GitProject::class, function (Faker $faker) {
    return [
        'project_url' => 'amitavroy/' . $faker->word,
        'stars' => $faker->numberBetween(0, 10),
        'issues' => $faker->numberBetween(0, 10),
        'meta' => serialize(['key' => 'value']),
        'meta' => serialize(['key' => 'value']),
    ];
});
