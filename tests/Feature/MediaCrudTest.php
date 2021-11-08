<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\Media;
use App\Models\User;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_media_can_be_created()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('s3');            

        $file = UploadedFile::fake()->image('teste_papai_noel.jpg')->size(200);

        $response = $this->post('/medias', [
            'name'        => 'Papai Noel de branco dia 24.',
            'description' => 'Imagem para ser colocada no dia 24 antes do Natal.',
            'file'        => $file,
        ]);  

        $this->assertDatabaseCount('medias', 1);

        $media = Media::first();
        
        $this->assertNotNull($media->path);

        Storage::disk('s3')->assertExists($media->path);    
        
        $this->assertFileEquals($file, Storage::disk('s3')->path($media->path));   
         
        $response->assertRedirect(route('medias.index'));
    }

    /** @test */
    public function check_if_media_name_verification_is_working()
    {
        $response = $this->post('/medias', [
            'name'        => '',
            'description' => 'Uma mídia nova',
        ]);

        $response->assertSessionHasErrors('name');

        $response = $this->post('/medias', [
            // Name greater than 50 char. This string has 60 characters
            'name'        => 'g9jSjZGjFnd9lxIN4uUYdlFbH7xG77KE3MRRGkSu9Oe3WIEpBv07HmPRzxK5',
            'description' => 'Uma mídia nova',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function check_if_media_description_verification_is_working()
    {
        $response = $this->post('/medias', [
            'name'        => 'Teste',
            'description' => ''
        ]);

        $response->assertSessionHasErrors('description');

        $response = $this->post('/medias', [
            'name'        => 'Teste',
            // Description greater than 100 char. This string has 101 characters
            'description' => 'aA0SirvmmgytjdDmDCTeAm3VE26kB9u3CY5SlF4My0sWQNc6vHQLKgL3GQKVdupUBvocBaIXOPzkjt8BkXqrPbK95UhfusO7WwCaZ
            '
        ]);

        $response->assertSessionHasErrors('description');
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

        $response->assertRedirect($media->path());
    }

    /** @test */
    public function check_if_a_media_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('s3');     

        $response = $this->post('/medias', [
            'name'        => 'Papai Noel de branco dia 24.',
            'description' => 'Imagem para ser colocada no dia 24 antes do Natal.',
            'file'        => UploadedFile::fake()->image('teste_papai_noel.jpg')->size(200),
        ]);  

        $this->assertDatabaseCount('medias', 1);

        $media = Media::first();

        $response = $this->delete($media->path());

        $this->assertDeleted($media);
        Storage::disk('s3')->assertMissing($media->path);    

        $response->assertRedirect(route('medias.index'));
    }
}
