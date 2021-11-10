<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\User;
use App\Models\Media;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class MediaCrudTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function check_if_media_can_be_created()
    {
        Bus::fake();
        Storage::fake('s3'); 
     
        $this->actingAs(User::factory()->create());

        $file = UploadedFile::fake()->image('teste_papai_noel.jpg')->size(200);

        $response = $this->post('/medias', [
            'name'        => 'Papai Noel de branco dia 24.',
            'description' => 'Imagem para ser colocada no dia 24 antes do Natal.',
            'file'        => $file,
        ]);  

        $this->assertDatabaseCount('medias', 1);

        $media = Media::first();
        
        $this->assertNull($media->path);    
         
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
            'name'        => $this->faker->sentence(100),
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
            'description' => $this->faker->text(200),
            
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
        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('s3');     
        Bus::fake();

        $response = $this->post('/medias', [
            'name'        => 'Papai Noel de branco dia 24.',
            'description' => 'Imagem para ser colocada no dia 24 antes do Natal.',
            'file'        => UploadedFile::fake()->image('teste_papai_noel.jpg')->size(200),
        ]);  

        $this->assertDatabaseCount('medias', 1);

        $media = Media::first();

        Storage::disk('s3')->assertExists($media->path);

        $response = $this->delete($media->path());

        $this->assertDeleted($media);
        Storage::disk('s3')->assertMissing($media->path);    

        $response->assertRedirect(route('medias.index'));
    }
}
