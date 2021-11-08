<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Media;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Generates both the post and the media.
     *
     * @return void
     */
    public function run()
    {        
        $this->generateImagePosts();
        $this->generateRecurrentImagePosts();
        $this->generateVideoPosts();
        $this->generateRecurrentVideoPosts();
    }

    public function generateImagePosts()
    {
        Media::factory()
            ->count(20)
            ->image()
            ->hasPosts(3, function (array $attributes, Media $media) {
                return [
                    'duration' => mt_rand(1000, 2000),
                ];
            })
            ->create();
    }

    public function generateRecurrentImagePosts()
    {
        Media::factory()
            ->count(20)      
            ->image()              
            ->has(
                Post::factory()
                        ->count(3)
                        ->recurrent()
                        ->state(function (array $attributes, Media $media) {
                            return [
                                'duration' => mt_rand(1000, 2000),
                            ];
                        })
            )
            ->create();
    }

    public function generateVideoPosts()
    {
        Media::factory()
            ->count(20)
            ->video()
            ->hasPosts(3, function (array $attributes, Media $media) {
                return [
                    'duration' => $media->duration,
                ];
            })
            ->create();
    }

    public function generateRecurrentVideoPosts()
    {
        Media::factory()
            ->count(20)
            ->video()
            ->has(
                Post::factory()
                        ->count(3)
                        ->recurrent()
                        ->state(function (array $attributes, Media $media) {
                            return [
                                'duration' => $media->duration
                            ];
                        })
            )
            ->create();
    }
}
