<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_user_seed_is_working()
    {
        $this->withoutExceptionHandling();

        User::factory(50)->create(); 

        $users = User::all();
        
        $this->assertCount(50, $users);
        $this->assertInstanceOf(User::class, $users->first());
    }

    /** @test */
    public function check_if_user_seed_intus_admin_is_working()
    {
        $this->withoutExceptionHandling();

        User::factory()->intus_admin()->create(); 

        $users = User::all();
        
        $this->assertCount(1, $users);
        $this->assertInstanceOf(User::class, $users->first());
        $this->assertEquals('Intus', $users->first()->name);
    }
}
