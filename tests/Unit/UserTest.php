<?php

namespace Tests\Unit;

use App\Reply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;


class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    function a_user_can_fetch_the_most_recent_reply()
    {
        $user = factory(User::class)->create();
        $reply = factory(Reply::class)->create(['user_id'=>$user->id]);

        $this->assertEquals($reply->id, $user->lastReply->id);
    }


}
