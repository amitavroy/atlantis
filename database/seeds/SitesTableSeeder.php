<?php

use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Site::create([
            'name' => 'Amitav Roy',
            'url' => 'https://www.amitavroy.com',
            'email' => 'reachme@amitavroy.com',
        ]);

        \App\Site::create([
            'name' => 'SplitSecondPix',
            'url' => 'http://new.splitsecondpix.com',
            'email' => 'reachme@amitavroy.com',
        ]);
    }
}
