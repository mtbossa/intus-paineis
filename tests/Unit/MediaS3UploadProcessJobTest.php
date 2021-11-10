<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\UploadedFile;
use App\Jobs\MediaS3UploadProcess;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaS3UploadProcessJobTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function assert_media_upload_s3_process_job_is_being_dispatched()
    {
        $this->withoutExceptionHandling();

        Bus::fake();
        Storage::fake('s3'); 

        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('teste_papai_noel.jpg')->size(200);   
        
        $media = Media::factory()->image()->create(['path' => NULL]);

        MediaS3UploadProcess::dispatch(
            file: $file,
            destination: 'medias/1',
            filename: 'teste.png',
            media: $media
        );

        Bus::assertDispatched(MediaS3UploadProcess::class);      
    }   
    
    /** @test */
    public function assert_media_upload_s3_process_handle_method_is_working()
    {
        $this->withoutExceptionHandling();

        Storage::fake('s3'); 

        $file = UploadedFile::fake()->image('teste_papai_noel.jpg')->size(200);   
        
        $media = Media::factory()->image()->create([
            'path' => NULL
        ]);

        $process = new MediaS3UploadProcess(
            file: $file,
            destination: 'medias/1',
            filename: 'teste.png',
            media: $media
        );

        $process->handle();       

         // assert file exists and model is updated
        $this->assertDatabaseCount('medias', 1);
        $this->assertNotNull($media->path);

        Storage::disk('s3')->assertExists($media->path);    
    } 
}
