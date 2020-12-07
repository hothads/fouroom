<?php

namespace App\Http\Controllers;

use App\EmailList;
use Illuminate\Http\Request;
use PharIo\Manifest\Email;
use Predis\Response\Status;

class EmailListController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $lists = EmailList::where('user_id', auth()->user()->id)->get();
        return view('lists.index', compact('lists'));
    }

    public function create()
    {
        return view('lists.create');
    }

    public function store()
    {
        request()->validate([
            'title' => 'required'
        ]);

        $list = EmailList::create([
            'user_id'=>auth()->id(),
            'title'=>request('title'),
        ]);

        if(request()->wantsJson()) {
            return response($list, 201);
        }

        return redirect("/lists/$list->id/emails/create");
    }

    public function update(EmailList $list)
    {
        $this->authorize('update', $list);

        request()->validate([
            'title' => 'required'
        ]);

        $list->update([
            'title'=>request('title'),
        ]);

        if(request()->wantsJson()) {
            return response($list, 201);
        }

        return redirect("/lists/$list->id/emails/create");
    }



    public function destroy(EmailList $list) {

        $this->authorize('update', $list);
       
        $list->delete();
      
        if (request()->wantsJson())
        {
            return response([], 204);
        }

        return back();
    }
}
