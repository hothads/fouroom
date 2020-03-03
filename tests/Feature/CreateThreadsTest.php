<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Thread;
use App\User;

class CreateThreadsTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function guest_may_not_create_threads()
    {

        $this->post('/threads')
            ->assertRedirect('/login');

        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_can_create_new_forum_threads() 
    {
        $this->withoutExceptionHandling();


        $this->signIn();

        $thread = factory(Thread::class)->create();

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

}
