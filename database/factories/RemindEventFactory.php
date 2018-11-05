<?php

use Faker\Generator as Faker;

$factory->define(App\Models\RemindEvent::class, function (Faker $faker) {
    return [
        'reminder_id' => factory(\App\Models\Reminder::class)->create()->id,
        'reminder_at' => now(),
    ];
});
