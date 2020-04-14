<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Thread;
use App\User;
use App\Favorite;

class Reply extends Model
{
    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

	public function owner() 
	{
		return $this->belongsTo(User::class, 'user_id');
	}

    public function thread()
    {
    	return $this->belongsTo(Thread::class);
    }

    public function favorites()
    {
    	return $this->morphMany(Favorite::class, 'favorited');
    }

    public function isFavorited()
    {
    	return !! $this->favorites->where(['user_id'=>auth()->id()])->count();
    }

    public function getFavoritesCountAttributes()
    {
        return $this->favorites->count();
    }

}
