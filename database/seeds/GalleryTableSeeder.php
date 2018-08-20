<?php

use Illuminate\Database\Seeder;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gallery::create([
            'family_id' => 1,
            'user_id' => 1,
            'name' => 'My first gallery',
            'description' => 'This is my first gallery just for testing',
            'is_active' => 1,
        ]);

        factory(\App\Gallery::class, 10)->create([
            'family_id' => 1,
            'user_id' => 1,
            'is_active' => 1,
        ]);
    }
}
