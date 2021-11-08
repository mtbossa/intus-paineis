<?php

namespace Tests\Unit;

use Tests\TestCase;

use Database\Seeders\PostSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;   

    private $post_seeder;
    private $media_amount;
    private $post_amount;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->post_seeder  = new PostSeeder();
        $this->media_amount = 1;
        $this->post_amount  = 1;
    }


    /** @test */
    public function check_if_image_post_seed_is_working()
    {   
        $this->post_seeder->generateImagePosts(media_amount: $this->media_amount, post_amount: $this->post_amount);
      
        $this->assertDatabaseCount('medias', $this->media_amount);
        $this->assertDatabaseCount('posts', $this->post_amount);
    }

    /** @test */
    public function check_if_recurrent_image_post_seed_is_working()
    {
        $this->post_seeder->generateRecurrentImagePosts(media_amount: $this->media_amount, post_amount: $this->post_amount);

        $this->assertDatabaseCount('medias', $this->media_amount);
        $this->assertDatabaseCount('posts', $this->post_amount);
    }   

    /** @test */
    public function check_if_video_post_seed_is_working()
    {
        $this->post_seeder->generateVideoPosts(media_amount: $this->media_amount, post_amount: $this->post_amount);

        $this->assertDatabaseCount('medias', $this->media_amount);
        $this->assertDatabaseCount('posts', $this->post_amount);
    }
    
    /** @test */
    public function check_if_recurrent_video_post_seed_is_working()
    {
        $this->post_seeder->generateRecurrentVideoPosts(media_amount: $this->media_amount, post_amount: $this->post_amount);

        $this->assertDatabaseCount('medias', $this->media_amount);
        $this->assertDatabaseCount('posts', $this->post_amount);
    }   
}
