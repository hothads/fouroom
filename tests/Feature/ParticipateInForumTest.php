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

        $this->assertDatabaseHas('replies', ['body'=>$reply->body]);

        $this->assertEquals(1, $thread->fresh()->replies_count);
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

    /** @test */
    function unauthenticated_user_may_not_delete_replies() {

        $reply = factory('App\Reply')->create();

        $this->delete("/replies/{$reply->id}")
            ->assertRedirect('login');

        $this->signIn();

        $this->delete("/replies/{$reply->id}")->assertStatus(403);

    }

    /** @test */

    function auth_user_can_delete_replies() {

        $this->signIn();

        $reply = factory('App\Reply')->create(['user_id' => auth()->id()]);

        $this->delete("/replies/{$reply->id}")->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);

        $this->assertEquals(0, $reply->thread->fresh()->replies_count);

    }

    /** @test */

    function authorized_users_can_update_replies() {

        $this->signIn();

        $reply = factory('App\Reply')->create(['user_id' => auth()->id()]);

        $new_reply = 'new message';

        $this->patch("/replies/{$reply->id}", ['body' => $new_reply]);

        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $new_reply]);

    }

    /** @test */
    function unauthenticated_user_may_not_update_replies() {

        $reply = factory('App\Reply')->create();

        $this->patch("/replies/{$reply->id}")
            ->assertRedirect('login');

        $this->signIn();

        $this->patch("/replies/{$reply->id}")->assertStatus(403);


    }
}
