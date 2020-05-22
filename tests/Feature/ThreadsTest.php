<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Thread;
use App\Reply;

class ThreadsTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function a_user_can_browse_all_threads()
    {
        $thread = factory(Thread::class)->create();
        $response = $this->get('/threads')
        	->assertSee($thread->title);
    }


    /** @test */
    public function a_user_can_browse_a_single_thread()
    {
        $thread = factory(Thread::class)->create();
        $response = $this->get($thread->path())
        	->assertSee($thread->title);
    }


    /** @test */
    function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = factory('App\Channel')->create();
        $threadInChannel = factory('App\Thread')->create(['channel_id'=>$channel->id]);
        $threadNotInChannel = factory('App\Thread')->create();
        $this->get('/threads/'.$channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */

    function a_user_can_filter_threads_by_any_username()
    {
        $user = factory('App\User')->create(['name'=>'John']);
        $this->signIn($user);
        $threadByJohn = factory('App\Thread')->create(['user_id'=>auth()->id()]);
        $threadNotByJohn = factory('App\Thread')->create();
        $this->get('threads?by=John')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

    /** @test */

    function a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = factory('App\Thread')->create();
        $threadWithThreeReplies = factory('App\Thread')->create();
        $threadWithZeroReplies = factory('App\Thread')->create();
        factory('App\Reply', 2)->create(['thread_id' => $threadWithTwoReplies->id]);
        factory('App\Reply', 3)->create(['thread_id' => $threadWithThreeReplies->id]);
        $response = $this->getJson('threads?popular=1')->json();
        $this->assertEquals([3,2,0], array_column($response, 'replies_count'));
    }

    /** @test */
    function a_user_can_filter_threads_by_unanswered()
    {
        $thread = factory('App\Thread', 2)->create();
        factory('App\Reply')->create(['thread_id' => Thread::first()->id]);
        $response = $this->getJson('threads?unanswered=1')->json();
        $this->assertCount(1, $response);
    }

    /** @test */
    function a_user_can_request_all_replies_for_given_thread()
    {
        $thread = factory(Thread::class)->create();
        factory(Reply::class, 2)->create(['thread_id'=>$thread->id]);
        $response = $this->get($thread->path().'/replies')->json();
        $this->assertCount(2, $response['data']);
        $this->assertEquals(2, $response['total']);
    }

    /** @test */
    function a_thread_can_be_subscribe_to()
    {
        $thread = factory(Thread::class)->create();
        $thread->subscribe($userId = 1);
        $this->assertEquals(
            1,
            $thread->subsciptions()->where('user_id',$userId)->count()
        );
    }

    /** @test */
    function a_thread_can_be_unsubscribe_from()
    {
        $thread = factory(Thread::class)->create();
        $thread->subscribe($userId = 1);
        $thread->unsubscribe($userId);
        $this->assertCount(0, $thread->subsciptions);
    }
}
