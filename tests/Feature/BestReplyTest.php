<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BestReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_thread_creator_may_mark_any_reply_as_the_best_answer()
    {
        $this->withoutExceptionHandling();

        $this->signIn();
        $thread = factory('App\Thread')->create(['user_id'=>auth()->id()]);
        $replies = factory('App\Reply', 2)->create(['thread_id' => $thread->id]);
        $this->assertFalse($replies[1]->isBest());
        $this->postJson(route('best-replies.store', [$replies[1]->id]));
        $this->assertTrue($replies[1]->fresh()->isBest());
    }

    /** @test */
    public function only_a_thread_creator_may_mark_reply_as_best()
    {
        $this->signIn();
        $thread = factory('App\Thread')->create(['user_id'=>auth()->id()]);
        $replies = factory('App\Reply', 2)->create(['thread_id' => $thread->id]);

        $this->signIn(factory('App\User')->create());
        $this->postJson(route('best-replies.store', [$replies[1]->id]))->assertStatus(403);
        $this->assertFalse($replies[1]->fresh()->isBest());

    }

    /** @test */
    public function if_abest_reply_is_deleted_then_thread_is_properly_updated_to_reflect_that()
    {
        $this->signIn();
        $reply = factory('App\Reply')->create(['user_id' => auth()->id()]);
        $reply->thread->markBestReply($reply);
        $this->deleteJson(route('replies.destroy', $reply));
        $this->assertNull($reply->thread->fresh()->best_reply_id);

    }
}
