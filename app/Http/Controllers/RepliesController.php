<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Inspections\Spam;
use Illuminate\Http\Request;
use App\Thread;

class RepliesController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except('index');
	}

	public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(10);
    }


    public function store($channelId, Thread $thread)
    {
        try {
            $this->validateReply();

            $reply = $thread->addReply([
                'body' => request('body'),
                'user_id' => auth()->id()
            ]);
        } catch (\Exception $e) {
            return response(
                'Извините, но вы не можете сохранить изменения', 422
            );
        }


//    	if(request()->expectsJson()){
//    	    return $reply->load('owner');
//        }

//            return back()->with('flash', 'Ваш комментарий опубликован');

        return $reply->load('owner');


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

        try {
            $this->validateReply();

            $reply->update(request(['body']));
        } catch (\Exception $e) {
            return response(
                'Извините, но вы не можете сохранить изменения', 422
            );
        }





//        if (request()->expectsJson()){
//            return response('Комментарий обновлен');
//        }

        return back();
    }

    public function validateReply()
    {
        $this->validate(request(), ['body'=> 'required']);

        resolve(Spam::class)->detect(request('body'));
    }

}
