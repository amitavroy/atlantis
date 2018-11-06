<?php

use Illuminate\Database\Seeder;

class RemindersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Reminder::class)->create([
            'user_id' => 1,
            'title' => 'My birthday',
            'reminder_date' => \Carbon\Carbon::parse('1984-11-07'),
            'repeat' => 'yearly',
            'type' => 'birthday',
            'is_active' => 1,
        ]);

        factory(\App\Models\Reminder::class)->create([
            'user_id' => 1,
            'title' => 'Credit Card',
            'reminder_date' => \Carbon\Carbon::parse('2018-01-20'),
            'repeat' => 'monthly',
            'type' => 'bill',
            'is_active' => 1,
        ]);

        factory(\App\Models\Reminder::class)->create([
            'user_id' => 1,
            'title' => 'Electricity bill',
            'reminder_date' => \Carbon\Carbon::parse('2018-01-02'),
            'repeat' => 'monthly',
            'type' => 'bill',
            'is_active' => 1,
        ]);

        factory(\App\Models\Reminder::class)->create([
            'user_id' => 1,
            'title' => 'Mobile bill',
            'reminder_date' => \Carbon\Carbon::parse('2018-01-17'),
            'repeat' => 'monthly',
            'type' => 'bill',
            'is_active' => 1,
        ]);
    }
}
