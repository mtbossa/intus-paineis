<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Display;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function check_if_display_seed_is_working()
    {
        Display::factory()->count(50)->create(); 

        $this->assertDatabaseCount('displays', 50);
    }  
}
