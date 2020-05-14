<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
use App\Thread;

class RepliesController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}


    public function store($channelId, Thread $thread)
    {

        $this->validate(request(), ['body'=> 'required']);

    	$reply = $thread->addReply([
    		'body' => request('body'),
    		'user_id' => auth()->id()
    	]);

    	if(request()->expectsJson()){
    	    return $reply->load('owner');
        }

    	return back()->with('flash', 'Ваш комментарий опубликован');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        if (request()->expectsJson()){
            return response('Комментарий удален');
        }

        return back();
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->update(request(['body']));

        if (request()->expectsJson()){
            return response('Комментарий обновлен');
        }

        return back();
    }

}
