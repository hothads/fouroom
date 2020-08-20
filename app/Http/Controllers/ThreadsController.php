<?php

namespace App\Http\Controllers;

use App\Rules\SpamFree;
use App\Thread;
use App\Channel;
use App\Reply;
use App\Filters\ThreadFilters;
use App\Trending;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filters, Trending $trending)
    {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson())
        {
            return $threads;
        }

        return view('threads.index', [
            'threads'=>$threads,
            'trending'=>$trending->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        request()->validate([
            'title' => ['required', new SpamFree()],
            'body' => ['required', new SpamFree()],
            'channel_id' =>'required|exists:channels,id'
        ]);

        $thread = Thread::create([
            'user_id'=>auth()->id(),
            'channel_id'=>request('channel_id'),
            'title'=>request('title'),
            'body'=>request('body')
        ]);

        if(request()->wantsJson()) {
            return response($thread, 201);
        }

        return redirect($thread->path())
                ->with('flash', 'Ваш пост опубликован');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Thread $thread, Trending $trending)
    {
        if(auth()->check())
        {
            auth()->user()->read($thread);
        }

        $trending->push($thread);

        $thread->visits()->record();

        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        if (request()->wantsJson()){
            return response([], 204);
        }

        return redirect('/threads');

    }

    public function update($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $data = request()->validate([
            'title' => ['required', new SpamFree()],
            'body' => ['required', new SpamFree()],
        ]);

        $thread->update($data);

        return $thread;
    }

    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads->paginate(10);
    }
}
