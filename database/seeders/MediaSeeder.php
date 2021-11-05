<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Media::factory(50)->jpeg_image()->create();
        Media::factory(50)->png_image()->create();
        Media::factory(50)->mp4_video()->create();
    }
}
