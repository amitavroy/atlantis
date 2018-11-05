<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(SitesTableSeeder::class);
        $this->call(GalleryTableSeeder::class);
//        $this->call(RemindersTableSeeder::class);
    }
}
