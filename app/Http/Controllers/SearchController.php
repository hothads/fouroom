<?php

namespace App\Http\Controllers;

use App\{Thread, Trending};



class SearchController extends Controller
{
    public function show(Trending $trending) {

        if (request()->expectsJson()) {
            return Thread::search(request('q'))->paginate(25);
        }
//        $threads = Thread::search(request('q'))->paginate(25);
//
//        if(request()->expectsJson())
//        {
//            return $threads;
//        }

        return view('threads.search', [
//            'threads'=>$threads,
            'trending'=>$trending->get()
        ]);

    }
}
