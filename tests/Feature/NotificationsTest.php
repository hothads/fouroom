<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_notification_is_prepared_when_a_subscribed_thread_recieves_a_new_reply()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $thread = factory('App\Thread')->create()->subscribe();

//        $thread->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Some reply'
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $thread->addReply([
            'user_id' => factory('App\User')->create()->id,
            'body' => 'Some reply'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);

    }

    /** @test */
    public function a_user_can_mark_notifications_as_read() {

        $this->signIn();

        $this->withoutExceptionHandling();

        $thread = factory('App\Thread')->create()->subscribe();

        $thread->addReply([
            'user_id' => factory('App\User')->create()->id,
            'body' => 'Some reply'
        ]);

        $user = auth()->user();

        $this->assertCount(1, $user->unreadNotifications);

        $notificationId = $user->unreadNotifications->first()->id;

        $this->delete("/profiles/{$user->name}/notifications/{$notificationId}");

        $this->assertCount(0, $user->fresh()->unreadNotifications);

    }

    /** @test */
    public function a_user_can_fetch_their_unreadnotifications()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $thread = factory('App\Thread')->create()->subscribe();

        $thread->addReply([
            'user_id' => factory('App\User')->create()->id,
            'body' => 'Some reply'
        ]);

        $user = auth()->user();

        $response = $this->getJson("/profiles/{$user->name}/notifications/")->json();

        $this->assertCount(1, $response);
    }
}
