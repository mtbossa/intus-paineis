<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

use App\Models\Display;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayCrudTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function check_if_display_can_be_created()
    {
        $response = $this->post('/displays', [
            'name'     => 'Raspberry Mateus',
            'location' => 'Caxias do Sul'
        ]);

        $display = Display::first();

        $this->assertModelExists($display); 
        $response->assertRedirect($display->path());
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
        $display = Display::first();

        
        $response = $this->patch("/displays/{$display->id}", [
            'name'     => 'Antigo Display',
            'location' => 'Caxias do Sul'
        ]);        

        // It's possible to use Display::first() because there'll
        // be only one entry in the database.
        $this->assertEquals('Antigo Display', Display::first()->name);
        $this->assertEquals('Caxias do Sul', Display::first()->location);

        $response->assertRedirect($display->fresh()->path());
    }

    /** @test */
    public function check_if_a_display_can_be_deleted()
    {
        $response = $this->post('/displays', [
            'name'     => 'Novo Display',
            'location' => 'Porto Alegre'
        ]);

        $display = Display::first();
        
        $response = $this->delete("/displays/{$display->id}");        

        $this->assertDeleted($display);
        $response->assertRedirect(route('displays.index'));
    }
}
