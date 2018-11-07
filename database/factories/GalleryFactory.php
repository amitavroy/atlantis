<?php

use Faker\Generator as Faker;

$factory->define(\App\Gallery::class, function (Faker $faker) {
    $family = factory(\App\Models\Family::class)->create();
    return [
        'family_id' => $family->id,
        'user_id' => factory(\App\User::class)->create(['family_id' => $family->id]),
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'is_active' => 1,
        'is_private' => 0,
    ];
});
