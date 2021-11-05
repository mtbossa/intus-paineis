<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Display;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplaySeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_display_seed_is_working()
    {
        $this->withoutExceptionHandling();

        Display::factory()->times(50)->create(); 

        $posts = Display::all();
        
        $this->assertCount(50, $posts);
        $this->assertInstanceOf(Display::class, $posts->first());
    }
}
