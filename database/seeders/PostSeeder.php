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
        $media_amount =  6;
        $post_amount  =  6;    

        $this->generateImagePosts($media_amount, $post_amount);
        $this->generateRecurrentImagePosts($media_amount, $post_amount);
        $this->generateVideoPosts($media_amount, $post_amount);
        $this->generateRecurrentVideoPosts($media_amount, $post_amount);
    }

    public function generateImagePosts(int $media_amount, int $post_amount): void
    {
        Media::factory()
            ->count($media_amount)
            ->image()
            ->hasPosts($post_amount, function (array $attributes, Media $media) {
                return [
                    'duration' => mt_rand(1000, 2000),
                ];
            })
            ->create();
    }

    public function generateRecurrentImagePosts(int $media_amount, int $post_amount): void
    {
        Media::factory()
            ->count($media_amount)      
            ->image()              
            ->has(
                Post::factory()
                        ->count($post_amount)
                        ->recurrent()
                        ->state(function (array $attributes, Media $media) {
                            return [
                                'duration' => mt_rand(1000, 2000),
                            ];
                        })
            )
            ->create();
    }

    public function generateVideoPosts(int $media_amount, int $post_amount): void
    {
        Media::factory()
            ->count($media_amount)
            ->video()
            ->hasPosts($post_amount, function (array $attributes, Media $media) {
                return [
                    'duration' => $media->duration,
                ];
            })
            ->create();
    }

    public function generateRecurrentVideoPosts(int $media_amount, int $post_amount): void
    {
        Media::factory()
            ->count($media_amount)
            ->video()
            ->has(
                Post::factory()
                        ->count($post_amount)
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
