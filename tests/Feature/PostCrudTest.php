<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Media;
use App\Models\Recurrence;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostCrudTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function check_if_post_can_be_created()
    {
        $this->withoutExceptionHandling();

        $media      = Media::factory()->image()->create();
        $recurrence = Recurrence::factory()->create();
        
        $response = $this->post('/posts', [
            'duration'      => 5000,
            'start_date'    => '18/02/2002',
            'end_date'      => '18/02/2003',
            'start_time'    => '15:30:20',
            'end_time'      => '16:30:20',
            'media_id'      => $media->id,
            'recurrence_id' => $recurrence->id,
        ]);      

        $post = Post::first();
  
        $this->assertModelExists($post);
        $this->assertInstanceOf(Carbon::class, $post->start_date);
        $this->assertEquals('2002-02-18', $post->start_date->format('Y-m-d'));
        $this->assertEquals('2003-02-18', $post->end_date->format('Y-m-d'));
    }
}
