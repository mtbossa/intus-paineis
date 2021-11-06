<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Recurrence;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecurrenceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_recurrence_seed_is_working()
    {
        Recurrence::factory()->count(50)->create();
        
        $this->assertDatabaseCount('recurrences', 50);
    }
}
