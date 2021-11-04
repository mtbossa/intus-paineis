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
        $response = $this->post('/displays', [
            'name'     => 'Raspberry Mateus',
            'location' => 'Caxias do Sul'
        ]);

        $newlyCreatedDisplay = Display::first();

        $this->assertCount(1, Display::all());

        $response->assertRedirect($newlyCreatedDisplay->path());
    }

    /** @test */
    public function check_if_display_name_verification_is_working()
    {
        $response = $this->post('/displays', [
            'name'     => '',
            'location' => 'Caxias do Sul'
        ]);

        $response->assertSessionHasErrors('name');

        $response = $this->post('/displays',[
            'name'     => 'g9jSjZGjFnd9lxIN4uUYdlFbH7xG77KE3MRRGkSu9Oe3WIEpBv07HmPRzxK5',
            'location' => 'Caxias do Sul'
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function check_if_display_location_verification_is_working()
    {
        $response = $this->post('/displays', [
            'name'     => 'Teste',
            'location' => ''
        ]);

        $response->assertSessionHasErrors('location');

        $response = $this->post('/displays', [
            'name'     => 'Teste',
            'location' => 'g9jSjZGjFnd9lxIN4uUYdlFbH7xG77KE3MRRGkSu9Oe3WIEpBv07HmPRzxK5'
        ]);

        $response->assertSessionHasErrors('location');
    }

    /** @test */
    public function check_if_a_display_can_be_updated()
    {
        $this->post('/displays', [
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

        $response->assertRedirect($newlyCreatedDisplay->fresh()->path());
    }

    /** @test */
    public function check_if_a_display_can_be_deleted()
    {
        $response = $this->post('/displays', [
            'name'     => 'Novo Display',
            'location' => 'Porto Alegre'
        ]);

        // It's going to be the only entry in the database,
        // so it can be selected with Diplay::first()
        $newlyCreatedDisplay = Display::first();
        
        $response = $this->delete("/displays/{$newlyCreatedDisplay->id}");        

        $this->assertCount(0, Display::all());
        $response->assertRedirect('/displays');
    }
}
