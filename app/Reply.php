<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Thread;
use App\User;

class Reply extends Model
{
    protected $guarded = [];

	public function owner() 
	{
		return $this->belongsTo(User::class, 'user_id');
	}

    public function thread()
    {
    	return $this->belongsTo(Thread::class);
    }

}
