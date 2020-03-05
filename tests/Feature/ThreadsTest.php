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
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->create(['thread_id'=>$thread->id]); 

        $this->get($thread->path())
        	->assertSee($reply->body);  	
    }

    /** @test */ 
    function a_user_can_filter_threads_according_to_a_channel()
    {
        // $this->withoutExceptionHandling();

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

}
