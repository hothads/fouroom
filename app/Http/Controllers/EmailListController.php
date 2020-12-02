<?php

namespace App\Http\Controllers;

use App\EmailList;
use Illuminate\Http\Request;
use PharIo\Manifest\Email;

class EmailListController extends Controller
{
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



    public function destroy(EmailList $list) {
        if(auth()->user()->id === $list->owner->id)
        {
           $list->delete();
        }
        return back();
    }
}
