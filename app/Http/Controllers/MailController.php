<?php

namespace App\Http\Controllers;

use App\EmailList;
use App\Emails;
use App\Mail\SendMail;
use App\MessageTemplate;
use App\Signature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $lists = $user->emaillists;
        $templates = $user->messageTemplates;
        $signatures = $user->signatures;
//        $lists = EmailList::where('user_id', auth()->user()->id)->get();

        return view('emails.create', compact('lists', 'templates', 'signatures'));
    }

    public function store()
    {

        $recipients = [];

        $attributes = request()->validate([
            'list' => 'required',
            'template' => 'required',
            'signature' => 'required'
        ]);

        $list = EmailList::find($attributes['list']);
        $template = MessageTemplate::find($attributes['template']);
        $signature = Signature::find($attributes['signature']);

        $details = [
            'from' => $template->from,
            'subject' => $template->theme,
            'title' => $template->title,
            'body' => $template->body,
            'author' => $signature->name,
            'position' => $signature->position
        ];


//        $emails = Emails::where('email_list_id', request()->lists)->get();
        foreach ($list->emails as $email) {
            array_push($recipients, $email['email']);
        }


//
//        if (request()->emails) {
//            $emails = str_replace(' ', '', request()->emails);
//            $clean_emails = explode(';', $emails);
//            $recipients = array_merge($recipients, $clean_emails);
//        }

        foreach ($recipients as $recipient) {

            if ($recipient == '') {
                continue;
            } else {
                Mail::to($recipient)->send(new SendMail($details));
                if (env('MAIL_HOST', false) == 'smtp.mailtrap.io') {
                    sleep(1); // I should do something instead
                }
            }
        }

        return back()->with('flash', 'Рассылка прошла успешно');

    }
}
