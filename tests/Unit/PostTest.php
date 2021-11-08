<?php

namespace Tests\Unit;

use Tests\TestCase;

use Database\Seeders\PostSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;   

    private $post_seeder;

    public function setUp(): void
    {
        parent::setUp();

        $this->post_seeder = new PostSeeder();
    }


    /** @test */
    public function check_if_image_post_seed_is_working()
    {   
        $this->post_seeder->generateImagePosts();

        $this->assertDatabaseCount('posts', 60);
        $this->assertDatabaseCount('medias', 20);
    }

    /** @test */
    public function check_if_recurrent_image_post_seed_is_working()
    {
        $this->post_seeder->generateRecurrentImagePosts();

        $this->assertDatabaseCount('posts', 60);
        $this->assertDatabaseCount('medias', 20);
    }   

    /** @test */
    public function check_if_video_post_seed_is_working()
    {
        $this->post_seeder->generateVideoPosts();

        $this->assertDatabaseCount('posts', 60);
        $this->assertDatabaseCount('medias', 20);
    }
    
    /** @test */
    public function check_if_recurrent_video_post_seed_is_working()
    {
        $this->post_seeder->generateRecurrentVideoPosts();

        $this->assertDatabaseCount('posts', 60);
        $this->assertDatabaseCount('medias', 20);
    }   

    /** @test */
    public function check_if_post_seeder_is_working()
    {
        $this->post_seeder->run();

        $this->assertDatabaseCount('posts', 240);
        $this->assertDatabaseCount('medias', 80);
    }   
}
