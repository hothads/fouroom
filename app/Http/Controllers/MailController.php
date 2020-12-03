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
    public function __construct()
	{
		$this->middleware('auth');
	}

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

        foreach ($list->emails as $email) {
            if($email->active == false){
                continue;
            } else {
                array_push($recipients, [
                    'email' => $email['email'],
                    'token' => $email['token'],
                    'id'=>$email['id']
                    ]);
            }
            
        }

        // dd($recipients);

        foreach ($recipients as $recipient) {

            if ($recipient == '') {
                continue;
            } else {
                $details['token'] = $recipient['token'];
                $details['id'] = $recipient['id'];
                Mail::to($recipient['email'])->send(new SendMail($details));
                if (env('MAIL_HOST', false) == 'smtp.mailtrap.io') {
                    sleep(1); // I should do something instead
                }
            }
        }

        return back()->with('flash', 'Рассылка прошла успешно');

    }
}
