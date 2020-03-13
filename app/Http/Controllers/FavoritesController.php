<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Favorite;

class FavoritesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function store(Reply $reply){
    	if (!$reply->favorites()->where(['user_id'=>auth()->id()])->exists())
    	{
    		$reply->favorites()->create(['user_id' => auth()->id()]);
    	}

    	return back();
    }
}
