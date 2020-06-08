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
//        $names = $event->reply->mentionedUsers();
//
//        foreach($names as $name)
//        {
//            $user = User::whereName($name)->first();
//
//            if($user) {
//                $user->notify(new YouWereMentioned($event->reply));
//            }
//        }

       collect($event->reply->mentionedUsers())
           ->map(function ($name){
               return User::where('name', $name)->first();
           })
           ->each(function($user) use ($event){
               $user->notify(new YouWereMentioned($event->reply));
           });

    }
}
