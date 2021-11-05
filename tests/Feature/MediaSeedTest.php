<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Media;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaSeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_media_seed_jpeg_image_is_working()
    {
        $this->withoutExceptionHandling();

        Media::factory(50)->jpeg_image()->create(); 

        $medias = Media::all();
        
        $this->assertCount(50, $medias);
        $this->assertInstanceOf(Media::class, $medias->first());
        $this->assertEquals('jpeg', $medias->first()->extension);
    }

    /** @test */
    public function check_if_media_seed_png_image_is_working()
    {
        $this->withoutExceptionHandling();

        Media::factory(50)->png_image()->create(); 

        $medias = Media::all();
        
        $this->assertCount(50, $medias);
        $this->assertInstanceOf(Media::class, $medias->first());
        $this->assertEquals('png', $medias->first()->extension);
    }

    /** @test */
    public function check_if_media_seed_mp4_video_is_working()
    {
        $this->withoutExceptionHandling();

        Media::factory(50)->mp4_video()->create(); 

        $medias = Media::all();
        
        $this->assertCount(50, $medias);
        $this->assertInstanceOf(Media::class, $medias->first());
        $this->assertEquals('mp4', $medias->first()->extension);
    }
}
