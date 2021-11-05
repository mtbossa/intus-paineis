<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Media;

use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_media_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/medias', [
            'name'        => 'Papai Noel de branco dia 24.',
            'description' => 'Imagem para ser colocada no dia 24 antes do Natal.',
        ]);

        $response->assertOk();

        $this->assertCount(1, Media::all());
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
        $this->withoutExceptionHandling();

        $this->post('/medias',[
            'name'     => 'Novo media',
            'location' => 'Porto Alegre'
        ]);

        // It's going to be the only entry in the database,
        // so it can be selected with Diplay::first()
        $newlyCreatedmedia = Media::first();

        
        $response = $this->patch("/medias/{$newlyCreatedmedia->id}", [
            'name'     => 'Antigo media',
            'location' => 'Caxias do Sul'
        ]);        

        // It's possible to use media::first() because there'll
        // be only one entry in the database.
        $this->assertEquals('Antigo media', Media::first()->name);
        $this->assertEquals('Caxias do Sul', Media::first()->location);
    }

    /** @test */
    public function check_if_a_media_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/medias',[
            'name'     => 'Novo media',
            'location' => 'Porto Alegre'
        ]);

        // It's going to be the only entry in the database,
        // so it can be selected with Diplay::first()
        $newlyCreatedmedia = Media::first();
        
        $response = $this->delete("/medias/{$newlyCreatedmedia->id}");        

        $this->assertCount(0, Media::all());
    }
}
