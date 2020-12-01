<?php

namespace App\Http\Controllers;

use App\EmailList;
use App\Emails;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function create()
    {
        $lists = EmailList::where('user_id', auth()->user()->id)->get();

        return view('emails.create', compact('lists'));
    }

    public function store()
    {

        $recipients = [];

        $details = [
            'title' => 'title',
            'body' => 'message text',
        ];

        if (request()->lists)
        {
            $emails = Emails::where('email_list_id', request()->lists)->get();
            foreach ($emails as $email) {
                array_push($recipients, $email['email']);
            }
        }

        if (request()->emails) {
            $emails = str_replace(' ', '', request()->emails);
            $clean_emails = explode(';', $emails);
            $recipients = array_merge($recipients, $clean_emails);
        }


        foreach ($recipients as $recipient) {

            if ($recipient == '') {
                continue;
            } else {
                Mail::to($recipient)->send(new SendMail($details));
                if(env('MAIL_HOST', false)=='smtp.mailtrap.io'){
                    sleep(1); // I should do something instead
                }
            }
        }

        if(request()->emails == 0 && request()->lists == 0)
        {
            return back()->with('flash', 'Вы не выбрали получателей');
        } else {
            return back()->with('flash', 'Письма отправлены');
        }

    }
}
