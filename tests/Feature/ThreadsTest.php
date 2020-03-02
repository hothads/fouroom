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

        $response = $this->get('/threads/'.$thread->id)
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

}
