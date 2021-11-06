<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_user_seed_is_working()
    {
        User::factory()->count(50)->create(); 

        $this->assertDatabaseCount('users', 50);
    }

    /** @test */
    public function check_if_user_seed_intus_admin_is_working()
    {
        $user = User::factory()->intus_admin()->create(); 
        
        $this->assertDatabaseCount('users', 1);
        $this->assertEquals('Intus', $user->name);
    }
}
