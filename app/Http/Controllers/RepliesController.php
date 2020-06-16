<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Notifications\YouWereMentioned;
use App\Reply;
use App\Rules\SpamFree;
use App\User;
use Illuminate\Http\Request;
use App\Thread;
use Illuminate\Support\Facades\Gate;

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


    public function store($channelId, Thread $thread, CreatePostRequest $form)
    {
        return $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ])->load('owner');

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

        request()->validate( ['body' => ['required', new SpamFree] ]);

        $reply->update(request(['body']));


    }


}
