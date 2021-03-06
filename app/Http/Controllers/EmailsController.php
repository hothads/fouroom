<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Emails;
use App\EmailList;
use Illuminate\Http\Request;
use App\Imports\EmailsImport;
use Maatwebsite\Excel\Facades\Excel;


class EmailsController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}


    public function create(EmailList $list)
    {
        return view('emails.add', compact('list'));
    }


    public function edit($emails)
    {
        $this->authorize('update', $emails);

        return view('emails.show', ['email' => Emails::findOrFail($emails)]);
    }


    public function store(EmailList $list)
    {
        $this->authorize('update', $list);

        $attributes = request()->validate([
            'email' => 'required|email',
            'user_name' => '',
            'organisation' => '',
            'source' => ''
        ]);

        $attributes['token'] = Str::random(10);

        $list->addEmail($attributes);

        return back();
        
    }


    public function update(Emails $emails)
    {

        $this->authorize('update', $emails);

        $attributes = request()->validate([
            'email' => 'required|email',
            'user_name' => '',
            'organisation' => '',
            'source' => '',
        ]);

        $attributes['active']= request()->has('active');

        if($attributes['active'] !== $emails->active)
        {
            auth()->user()->addSendLog([
                'template_id'=> null,
                'template_message'=> null,
                'list_id'=>$emails->emaillist->id,
                'list_title'=>$emails->emaillist->title,
                'action' => $attributes['active'] == null ? 'Заблокировал пользователя' : 'Разблокировал пользователя',
                'email'=>$emails->email
            ]);
        }

        $emails->update($attributes);

        return back();
    }

    public function unsubscribe(Emails $email) {
        
        if (request('token') == $email->token){
            $email->update(['active' => false]);
            return view('emails.unsubscribe');
        } else {
            abort(403);
        }
    }

    public function destroy(EmailList $list, Emails $email)
    {

        $this->authorize('update', $email);

        $email->delete();

        return back();

    }


    public function importExcel(EmailList $list)
    {

        request()->validate([
            'file' => 'required|file|mimes:xlsx'
        ]);

        $emailsExisted = Emails::where('email_list_id', $list->id)->get();
        $emails = Excel::toArray(new EmailsImport, request()->file);
        $errors = [];
        $count = count($emails);

        for ($i = 0; $i < $count; $i++) {
            foreach ($emails[$i] as $data) {
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, $data['email']);
                }
            }
        }

        if ($errors) {
            return view('emails.errors', compact('errors', 'list'));
        } else {

            for ($i = 0; $i < $count; $i++) {

                foreach ($emails[$i] as $data) {

                    if($this->checkEmailName($emailsExisted, $data['email']))
                    {
                        continue;
                    } else {
                        $list->addEmail([
                            'token' => Str::random(10),
                            'email' => $data['email'],
                            'user_name' => $data['user_name'],
                            'organisation' => $data['organisation'],
                            'source' => $data['source']
                        ]);
                    }

                }

            }

            return back()->with('flash', 'Данные загружены');
        }
    }

    public function checkEmailName($emails, $data){

        $items = 0;

        foreach($emails as $email) {
            if($email->where('email', $data)->exists()){
                $items++;
            }
        }

        return $items > 0 ? 1 : 0;
    }

}
