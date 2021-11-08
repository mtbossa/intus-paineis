<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Models\Post;
use App\Models\Media;
use App\Models\Recurrence;
use Database\Seeders\PostSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;   

    /** @test */
    public function check_if_image_post_seed_is_working()
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

        $this->assertDatabaseCount('posts', 60);
        $this->assertDatabaseCount('medias', 20);
    }

    /** @test */
    public function check_if_recurrent_image_post_seed_is_working()
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

        $this->assertDatabaseCount('posts', 60);
        $this->assertDatabaseCount('medias', 20);
    }   

    /** @test */
    public function check_if_video_post_seed_is_working()
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

        $this->assertDatabaseCount('posts', 60);
        $this->assertDatabaseCount('medias', 20);
    }
    
    /** @test */
    public function check_if_recurrent_video_post_seed_is_working()
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

        $this->assertDatabaseCount('posts', 60);
        $this->assertDatabaseCount('medias', 20);
    }   

    /** @test */
    public function check_if_post_seeder_is_working()
    {
        $post_seeder = new PostSeeder();

        $post_seeder->run();

        $this->assertDatabaseCount('posts', 240);
        $this->assertDatabaseCount('medias', 80);
    }   
}
