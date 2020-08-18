<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Thread;
use App\Reply;

class LockThreadsTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function non_administrators_may_not_lock_threads()
    {
        $this->signIn();
        $thread = factory('App\Thread')->create(['user_id' => auth()->id()]);
        $this->post(route('locked-threads.store', $thread))->assertStatus(403);
        $this->assertFalse(!! $thread->fresh()->locked); // !! to a boolean

    }

    /** @test */
    public function administrators_can_lock_threads()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        $thread = factory('App\Thread')->create(['user_id' => auth()->id()]);
        $this->post(route('locked-threads.store', $thread));
        $this->assertTrue($thread->fresh()->locked); // !! to a boolean
    }


    /** @test */
    public function administrators_can_unlock_threads()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        $thread = factory('App\Thread')->create(['user_id' => auth()->id(), 'locked'=>true]);
        $this->delete(route('locked-threads.destroy', $thread));
        $this->assertFalse($thread->fresh()->locked, 'failed asserting that the thread was unlocked'); // !! to a boolean
    }


    /** @test */
    public function once_locked_a_thread_may_not_receive_new_replies()
    {
        $this->signIn();
        $thread = factory('App\Thread')->create();
        $thread->update(['locked' => true]);
        $this->post($thread->path() . '/replies', [
            'body' => 'Foobar',
            'user_id' => auth()->id()
        ])->assertStatus(422);
    }
}
