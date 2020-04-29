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
        $user = factory(User::class)->create();

        $this->signIn($user);

        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }


    /** @test */
    public function profiles_display_all_threads_with_assosiated_user()
    {
        $this->signIn();

        $thread = factory(Thread::class)->create(['user_id'=>auth()->id()]);

        $this->get("/profiles/".auth()->user()->name)
            ->assertSee($thread->title);


    }




}
