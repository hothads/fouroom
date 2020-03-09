<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;
use App\User;

class Thread extends Model
{
    protected $guarded = [];

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
        $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
