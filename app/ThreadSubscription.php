<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Thread;
use App\Notifications\ThreadWasUpdated;

class ThreadSubscription extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notify($reply)
    {
        $this->user->notify(new ThreadWasUpdated($this->thread, $reply));
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
