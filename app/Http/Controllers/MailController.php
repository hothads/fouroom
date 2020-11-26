<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function create()
    {
        return view('emails.create');
    }

    public function store()
    {
        request()->validate([
            'title'=>'required|max:255',
            'body'=>'required',
            'emails'=>'email'
        ]);


        $details = [
            'title' => request()->title,
            'body' => request()->body
        ];

        $recipients = [
            'first@mail.ru',
            'second@mail.ru',
            'third@mail.ru'
        ];

        foreach($recipients as $recipient) {

            Mail::to($recipient)->send(new SendMail($details));

        }

        return 'email sent';

    }
}
