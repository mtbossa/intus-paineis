<?php

namespace Database\Seeders;

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
        $this->call(UserSeeder::class);
        $this->call(DisplaySeeder::class);
        // PostSeeder generates rows for medias, recurrences and posts tables
        $this->call(PostSeeder::class);
    }
}
