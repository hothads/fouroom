<?php

namespace App\Listeners;

use App\Events\ThreadReseivedNewReply;

class NotifySubscribers
{
    /**
     * Handle the event.
     *
     * @param  ThreadReseivedNewReply  $event
     * @return void
     */
    public function handle(ThreadReseivedNewReply $event)
    {
        $thread = $event->reply->thread;

        $thread->subscriptions
            ->where('user_id', '!=', $event->reply->user_id)
            ->each
            ->notify($event->reply);
    }
}
