<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Display;

class CreateDislayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function display_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/displays',[
            'name'     => 'Raspberry Mateus',
            'location' => 'Caxias do Sul'
        ]);

        $response->assertOk();

        $this->assertCount(1, Display::all());
    }
}
