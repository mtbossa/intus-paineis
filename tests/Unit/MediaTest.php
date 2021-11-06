<?php

namespace Tests\Unit;

use App\Services\MediaService;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Media;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_media_seed_jpeg_image_is_working()
    {
        Media::factory()->count(50)->jpeg_image()->create(); 

        $media = Media::first();
        
        $this->assertDatabaseCount('medias', 50);
        $this->assertEquals('jpeg', $media->extension);
    }

    /** @test */
    public function check_if_media_seed_png_image_is_working()
    {
        Media::factory()->count(50)->png_image()->create(); 

        $media = Media::first();
        
        $this->assertDatabaseCount('medias', 50);
        $this->assertEquals('png', $media->extension);
    }

    /** @test */
    public function check_if_media_seed_mp4_video_is_working()
    {
        Media::factory(50)->mp4_video()->create(); 

        $media = Media::first();
        
        $this->assertDatabaseCount('medias', 50);
        $this->assertEquals('mp4', $media->extension);
    }

    /** @test */
    public function check_if_media_filename_is_being_formatted()
    {
        $media_name      = 'Nome da midia deve ficar assim 23';
        $media_extension = 'png';

        $current = Carbon::now()->format('Y-m-d-H-m-s');

        $media_filename = MediaService::generateFilename($media_name, $media_extension);

        $current = Carbon::now()->format('Y-m-d-H-m-s');

        $this->assertEquals("{$current}-nome-da-midia-deve-ficar-assim-23.png", $media_filename);
    }
}
