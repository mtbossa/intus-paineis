<?php

namespace Tests\Feature;

use App\Http\Livewire\Forms\MediaCreate;
use Tests\TestCase;

use App\Models\User;
use App\Models\Media;
use Livewire\Livewire;
use App\Services\MediaService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaCrudTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    /** @test */
    public function check_if_media_can_be_created()
    {
        $this->withoutExceptionHandling();
        Bus::fake();
        Storage::fake('local');   
        Storage::fake('s3');   
        
        $file = UploadedFile::fake()->image('teste_papai_noel.jpg')->size(200);
        $filename = MediaService::generateFilename('Papai Noel de branco dia 24.', 'jpg');

        Livewire::test(MediaCreate::class)
            ->set('name', 'Papai Noel de branco dia 24.')
            ->set('description', 'Imagem para ser colocada no dia 24 antes do Natal.')
            ->set('media', $file)
            ->call('storeMedia')
            ->assertRedirect(route('medias.index'));

        $this->assertDatabaseCount('medias', 1);

        $media = Media::first();
        
        $this->assertNull($media->path);   
        
        Storage::disk('local')->assertExists("tmp/medias/uploads/{$this->user->id}/$filename");
    }

    /** @test */
    public function check_if_media_name_verification_is_working()
    { 
        Livewire::test(MediaCreate::class)
        ->set('name', '')
        ->call('storeMedia')
        ->assertHasErrors(['name' => 'required']);
    }

    /** @test */
    public function check_if_media_description_verification_is_working()
    {
        Livewire::test(MediaCreate::class)
        ->set('description', '')
        ->call('storeMedia')
        ->assertHasErrors(['description' => 'required']);
    }

    /** @test */
    public function check_if_media_file_verification_is_working()
    {
        Livewire::test(MediaCreate::class)
        ->set('media', null)
        ->call('storeMedia')
        ->assertHasErrors(['media' => 'required']);
    }

    /** @test */
    public function check_if_media_file_type_verification_is_working()
    {        
        $file = UploadedFile::fake()->create('teste.pdf', 9900, 'application/pdf');

        Livewire::test(MediaCreate::class)
            ->set('media', $file)
            ->call('storeMedia')
            ->assertHasErrors(['media' => 'mimes']);
    }

    /** @test */
    public function check_if_a_media_can_be_updated()
    {
        $media = Media::factory()->image()->create();
        
        $response = $this->patch("/medias/{$media->id}", [
            'name'        => 'Antigo media',
            'description' => 'Caxias do Sul'
        ]);        

        $this->assertEquals('Antigo media', $media->fresh()->name);
        $this->assertEquals('Caxias do Sul', $media->fresh()->description);

        $response->assertRedirect($media->path() . '/edit');
    }

    /** @test */
    public function check_if_a_media_can_be_deleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('s3');     
        Storage::fake('local');     
        Bus::fake();

        Livewire::test(MediaCreate::class)
            ->set('name', 'Papai Noel de branco dia 24.')
            ->set('description', 'Imagem para ser colocada no dia 24 antes do Natal.')
            ->set('media', UploadedFile::fake()->image('teste_papai_noel.jpg')->size(200),)
            ->call('storeMedia');

        $this->assertDatabaseCount('medias', 1);

        $media = Media::first();

        Storage::disk('s3')->assertExists($media->path);

        $response = $this->delete($media->path());

        $this->assertDeleted($media);
        Storage::disk('s3')->assertMissing($media->path);    

        $response->assertRedirect(route('medias.index'));
    }
}
