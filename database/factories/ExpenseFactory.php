<?php

use Faker\Generator as Faker;

$factory->define(\App\Expense::class, function (Faker $faker) {
    return [
        'family_id' => 1,
        'user_id' => factory(\App\User::class)->create()->id,
        'description' => $faker->sentence,
        'expense_type_id' => factory(\App\ExpenseType::class)->create()->id,
        'amount' => $faker->numberBetween(1, 500),
        'transaction_date' => $faker->date('Y-m-d'),
        'payment_method' => $faker->randomElement(['Cash', 'Net Banking', 'Credit Card']),
    ];
});

$factory->define(\App\ExpenseType::class, function (Faker $faker) {
    return [
        'family_id' => 1,
        'name' => $faker->word,
    ];
});
