<?php

namespace Tests\Unit;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_thread_has_a_creator()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf('App\User', $thread->creator);

    }

    /** @test */
    function a_thread_has_replies()
    {
        $thread = factory('App\Thread')->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);
    }



    /** @test */
    function a_thread_can_add_a_reply()
    {
        $thread = factory('App\Thread')->create();

        $thread->addReply([
            'body' => 'tada',
            'user_id' => 1
        ]);

        $this->assertCount(1, $thread->replies);

    }

    /** @test */
    function a_thread_notifies_all_registered_subsribers_when_a_reply_is_added()
    {
        Notification::fake();

        $thread = factory('App\Thread')->create();

        $this->signIn();

        $thread->subscribe();

        $thread->addReply([
            'body' => 'tada',
            'user_id' => 1
        ]);

        Notification::assertSentTo(auth()->user(), ThreadWasUpdated::class);



    }

    /** @test */

    function a_thread_belongs_to_a_chanel()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf('App\Channel', $thread->channel);
    }

    /** @test */
    function a_thread_can_make_a_string_path()
    {
        $thread = factory('App\Thread')->make();

        $this->assertEquals('/threads/'.$thread->channel->slug.'/'.$thread->id, $thread->path());
    }

    /** @test */
    function it_knows_that_auth_user_is_subscribed_to_it()
    {
        $thread = factory('App\Thread')->create();

        $this->assertFalse($thread->isSubscribedTo);

        $this->signin();

        $thread->subscribe();

        $this->assertTrue($thread->isSubscribedTo);


    }


}
