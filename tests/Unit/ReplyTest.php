<?php

namespace Tests\Unit;

use App\Reply;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ReplyTest extends TestCase
{
	use RefreshDatabase;

	/** @test */

	function it_has_an_owner()
	{
		$reply = factory('App\Reply')->create();

		$this->assertInstanceOf('App\User', $reply->owner);
	}

	function it_knows_that_if_it_was_just_published()
    {
        $reply = factory('App\Reply')->create();
        $this->assertTrue($reply->wasJustAdded());

        $reply->created_at = Carbon::now()->subMonth();
        $this->assertFalse($reply->wasJustAdded());

    }

    /** @test */
    function it_can_detect_all_users_in_the_body()
    {
        $reply = factory(Reply::class)->create(['body'=>'@John to @Sara']);

        $this->assertEquals(['John', 'Sara'], $reply->mentionedUsers());
    }

    /** @test */
    function it_wraps_mentioned_usernames_in_the_body_within_anchor_tags()
    {
        $reply = new Reply([
            'body' => 'Hello @Jane-Doe'
        ]);


        $this->assertEquals(
            'Hello <a href="/profiles/Jane-Doe">@Jane-Doe</a>',
            $reply->body
        );
    }

    /** @test */
    public function it_knows_if_it_is_best_reply()
    {
           $reply = factory('App\Reply')->create();
           $this->assertFalse($reply->isBest());
           $reply->thread->update(['best_reply_id' => $reply->id]);
           $this->assertTrue($reply->fresh()->isBest());

    }

}
