<?php

use Illuminate\Database\Seeder;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ExpenseType::create([
            'family_id' => 1,
            'name' => 'Bills',
        ]);

        \App\ExpenseType::create([
            'family_id' => 1,
            'name' => 'Travel',
        ]);

        \App\ExpenseType::create([
            'family_id' => 1,
            'name' => 'Household',
        ]);
    }
}
