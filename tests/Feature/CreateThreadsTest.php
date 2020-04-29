<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Thread;
use App\User;
use App\Reply;

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

        $thread = factory(Thread::class)->make();

        $response = $this->post('/threads', $thread->toArray());

        //it will return url of just created thread
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }


    /** @test */

    function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }


    /** @test */

    function a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }


    /** @test */
    public function a_thread_can_be_deleted()
    {
        $user = $this->signIn();

        $thread = factory(Thread::class)->create(['user_id' => $user->id]);
        $reply = factory(Reply::class)->create(['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());

        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);

        $this->assertDatabaseMissing('activities', [
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread)
        ]);

        $this->assertDatabaseMissing('activities', [
            'subject_id' => $reply->id,
            'subject_type' => get_class($reply)
        ]);
    }


    /** @test */
    public function unautherized_users_may_not_delete_threads()
    {
        $thread = factory(Thread::class)->create();

        $this->delete($thread->path())->assertRedirect('/login');

        $this->signIn();

        $this->delete($thread->path())->assertStatus(403);

    }


    public function publishThread($overrides = [])
    {
        $this->signIn();

        $thread = factory(Thread::class)->make($overrides);

        return $this->post('/threads', $thread->toArray());
    }


}
