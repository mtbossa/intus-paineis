<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Display;

class DisplayCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_display_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/displays',[
            'name'     => 'Raspberry Mateus',
            'location' => 'Caxias do Sul'
        ]);

        $response->assertOk();

        $this->assertCount(1, Display::all());
    }

    /** @test */
    public function check_if_display_name_verification_is_working()
    {
        $response = $this->post('/displays',[
            'name'     => '',
            'location' => 'Caxias do Sul'
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function check_if_display_location_verification_is_working()
    {
        $response = $this->post('/displays',[
            'name'     => 'Teste',
            'location' => ''
        ]);

        $response->assertSessionHasErrors('location');
    }

    /** @test */
    public function check_if_a_display_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/displays',[
            'name'     => 'Novo Display',
            'location' => 'Porto Alegre'
        ]);

        // It's going to be the only entry in the database,
        // so it can be selected with Diplay::first()
        $newlyCreatedDisplay = Display::first();

        
        $response = $this->patch("/displays/{$newlyCreatedDisplay->id}", [
            'name'     => 'Antigo Display',
            'location' => 'Caxias do Sul'
        ]);        

        // It's possible to use Display::first() because there'll
        // be only one entry in the database.
        $this->assertEquals('Antigo Display', Display::first()->name);
        $this->assertEquals('Caxias do Sul', Display::first()->location);
    }

    /** @test */
    public function check_if_a_display_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/displays',[
            'name'     => 'Novo Display',
            'location' => 'Porto Alegre'
        ]);

        // It's going to be the only entry in the database,
        // so it can be selected with Diplay::first()
        $newlyCreatedDisplay = Display::first();
        
        $response = $this->delete("/displays/{$newlyCreatedDisplay->id}");        

        $this->assertCount(0, Display::all());
    }
}
