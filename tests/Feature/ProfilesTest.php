<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Thread;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_a_profile()
    {
        // $this->withoutExceptionHendling();

        $user = factory(User::class)->create();

        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);            
    }


    /** @test */
    public function profiles_display_all_threads_with_assosiated_user()
    {
        $user = factory(User::class)->create();

        $thread = factory(Thread::class)->create(['user_id'=>$user->id]);

        $this->get("/profiles/{$user->name}")
            ->assertSee($thread->title);

            
    }
    
    


}
