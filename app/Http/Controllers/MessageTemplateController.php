<?php

namespace App\Http\Controllers;

use App\MessageTemplate;
use Illuminate\Http\Request;

class MessageTemplateController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $templates = auth()->user()->messageTemplates;

//        if ($templates == null) {
//            return redirect('emails.templates.create');
//        }

        return view('emails.templates.index', compact('templates'));

    }

    public function create()
    {
        return view('emails.templates.create');
    }

    public function edit(MessageTemplate $template)
    {
        return view('emails.templates.edit', compact('template'));
    }

    public function update(MessageTemplate $template)
    {
        $attributes = request()->validate([
            'template_title' => 'required',
            'from' => 'required|email',
            'title' => 'required',
            'theme' => 'required',
            'body' => 'required',
        ]);

        $template->update($attributes);

        return back();
    }

    public function store()
    {
       $attributes = request()->validate([
            'template_title' => 'required',
            'from' => 'required|email',
            'title' => 'required',
            'theme' => 'required',
            'body' => 'required',
        ]);

       auth()->user()->addTemplate($attributes);

       return back()->with('flash', 'Шаблон успешно создан');
    }

    public function destroy(MessageTemplate $template)
    {
        $template->delete();
        return redirect('/templates');
    }
}
