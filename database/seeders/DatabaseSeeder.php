<?php

namespace Database\Seeders;

use App\Models\Display;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\DisplaySeeder;

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
        $this->call(DisplaySeeder::class);

        $posts = Post::all();
        $displays = Display::all();

        $posts->each(function ($post) use($displays) {
            $post->displays()->attach($displays->random(1));
        });
    }
}
