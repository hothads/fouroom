<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class MentionUsersTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function mentioned_users_in_a_reply_are_notified()
    {
        $john = factory(User::class)->create(['name'=>'JohnDoe']);

        $this->signIn($john);

        $jane = factory(User::class)->create(['name'=>'JaneDoe']);

        $thread = factory(Thread::class)->create();

        $reply = factory(Reply::class)
            ->make(['body'=>'@JaneDoe look at this.']);

        $this->json('post', $thread->path() . '/replies', $reply->toArray());

        $this->assertCount(1, $jane->notifications);
    }

    /** @test */

    function it_can_fetch_all_mentioned_users_starting_with_the_given_character()
    {
        factory(User::class)->create(['name'=>'johndoe']);
        factory(User::class)->create(['name'=>'johndoe2']);
        factory(User::class)->create(['name'=>'janedoe']);

        $results = $this->json('GET', '/api/users', ['name'=>'john']);

        $this->assertCount(2, $results->json());
    }
}
