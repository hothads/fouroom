<?php

namespace App\Listeners;

use App\Events\ThreadReseivedNewReply;
use App\Notifications\YouWereMentioned;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyMentionedUsers
{
    /**
     * Handle the event.
     *
     * @param  ThreadReseivedNewReply  $event
     * @return void
     */
    public function handle(ThreadReseivedNewReply $event)
    {


       User::whereIn('name', $event->reply->mentionedUsers())
           ->get()
           ->each(function($user) use ($event){
               $user->notify(new YouWereMentioned($event->reply));
           });

    }
}
