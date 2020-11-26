<?php

namespace App\Http\Controllers;

use App\Emails;
use Illuminate\Http\Request;
use App\Imports\EmailsImport;
use Maatwebsite\Excel\Facades\Excel;


class EmailsController extends Controller
{
    public function index()
    {
        $emails = Emails::all()->sortByDesc('created_at');
        return view('emails.index', compact('emails'));
    }

    public function show($emails)
    {
        return view('emails.show',  ['email'=> Emails::findOrFail($emails)] );
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'user_name' => '',
            'organisation' => '',
            'source' => ''
        ]);

        Emails::create($attributes);

        return back();

    }

    public function update(Emails $emails)
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'user_name' => '',
            'organisation' => '',
            'source' => ''
        ]);

        $emails->update($attributes);

        return back();
    }

    public function import(Request $request)
    {
        request()->validate([
            'file'=>'required|file|mimes:xlsx'
        ]);

        $emails = Excel::toArray(new EmailsImport, $request->file);
        $count = count($emails);

        for ($i = 0; $i < $count; $i++) {
            foreach ($emails[$i] as $data) {
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    return back()->with('flash', 'файл не прошел валидацию');
                }
            }
        }

        for ($i = 0; $i < $count; $i++) {

            foreach ($emails[$i] as $data)
            {
                if (Emails::where('email', $data['email'])->exists()) {
                    continue;
                }
                Emails::create([
                    'email' => $data['email'],
                    'user_name' => $data['user_name'],
                    'organisation' => $data['organisation'],
                    'source' => $data['source']
                ]);
            }

        }

        return back()->with('flash', 'Данные успешно загружены' );
    }

    public function validateExel()
    {
        request()->validate([
            'filecheck'=>'required|file|mimes:xlsx'
        ]);

        $emails = Excel::toArray(new EmailsImport, request()->filecheck);

        $errors = [];

        for ($i = 0; $i < count($emails); $i++) {
            foreach ($emails[$i] as $data) {
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, $data['email']);
                }
            }
        }

        if ($errors) {
            return view('emails.errors', compact('errors'));
        } else {
            return back()->with('flash', 'Файл прошел проверку email адресов');
        }

    }

}
