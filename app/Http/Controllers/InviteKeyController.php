<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\InviteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InviteKeyController extends Controller
{
    public function __construct()
	{
		$this->middleware('admin');
    }
    
    public function create()
    {
        return view('emails.components.InviteGuest');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email'
        ]);

        $key = auth()->user()->addKey($attributes);

        // dd($key->key);

        $details = ['key'=>$key->key];

        Mail::to($key->email)->send(new InviteUser($details));

        return back()->with('flash', 'Приглашение отправлено');
    }


}
