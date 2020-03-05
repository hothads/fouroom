<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauth_users_may_not_add_replies()
    {
        $this->post('/threads/some-channel/1/replies',[])
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_auth_user_may_participate_in_forum_threads()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\User')->create());

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->make();

        $this->post($thread->path().'/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }


    /** @test */
    function a_reply_reqires_a_body()
    {
        $this->signIn();

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->make(['body' => null]);

        $this->post($thread->path().'/replies', $reply->toArray())
            ->assertSessionHasErrors('body');

    }

}
