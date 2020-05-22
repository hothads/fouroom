<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;
use App\User;

class Thread extends Model
{

    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($thread) {

            $thread->replies->each->delete();

//            $thread->replies->each(function($reply){
//                $reply->delete();
//            });
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function addReply($reply)
    {
       return $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function subscribe($userId = null)
    {
        $this->subsciptions()->create([
           'user_id' => $userId ? : auth()->id()
        ]);
    }

    public function subsciptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function unsubscribe($userId = null)
    {
        $this->subsciptions()
            ->where('user_id', $userId ? : auth()->id())
            ->delete();
    }

}
