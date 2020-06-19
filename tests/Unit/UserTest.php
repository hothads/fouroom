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

    /** @test */
    public function a_user_can_determine_their_avatars_path()
    {
        $user = factory(User::class)->create();

        $this->assertEquals('avatars/default.jpg', $user->avatar_path);

        $user->avatar_path = 'avatars/me.jpg';

        $this->assertEquals('avatars/me.jpg', $user->avatar_path);


    }


}
