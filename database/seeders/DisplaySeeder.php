<?php

namespace Database\Seeders;

use App\Models\Display;
use Illuminate\Database\Seeder;

class DisplaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Display::factory(50)->create();
    }
}
