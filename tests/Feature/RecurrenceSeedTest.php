<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Recurrence;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecurrenceSeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_recurrence_seed_is_working()
    {
        $this->withoutExceptionHandling();

        Recurrence::factory()->times(50)->create(); 

        $recurrences = Recurrence::all();
        
        $this->assertCount(50, $recurrences);
        $this->assertInstanceOf(Recurrence::class, $recurrences->first());
    }
}
