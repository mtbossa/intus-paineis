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
        Storage::fake('local'); 

        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('teste_papai_noel.jpg')->size(200);   

        $path = $file->storeAs(
            'tmp/1',
            'teste.jpg',
            'local'
        );

        $media = Media::factory()->image()->create([
            'path' => NULL
        ]);

        MediaS3UploadProcess::dispatch(
            tmp_path: $path,
            destination: 'medias/1',
            filename: 'teste.png',
            media: $media
        );

        Bus::assertDispatched(MediaS3UploadProcess::class);      
    }   
    
    /** @test */
    public function assert_media_upload_s3_process_handle_method_is_working()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('local'); 
        Storage::fake('s3'); 

        $file = UploadedFile::fake()->image('teste_papai_noel.jpg')->size(200);  
        $tmp_folder  = 'tmp/medias/uploads/' . $user->id;

        $path = $file->storeAs(
            $tmp_folder,
            'teste.jpg',
            'local'
        );

        Storage::disk('local')->assertExists($path);   
        
        $media = Media::factory()->image()->create([
            'path' => NULL
        ]);

        $process = new MediaS3UploadProcess(
            tmp_path: $path,
            destination: 'medias/1',
            filename: 'teste.png',
            media: $media
        );

        $process->handle();       

        // assert file exists and model is updated
        $this->assertDatabaseCount('medias', 1);
        $this->assertNotNull($media->path);

        Storage::disk('s3')->assertExists($media->path);    
        Storage::disk('local')->assertMissing($path);    
    } 
}
