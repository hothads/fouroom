<?php

namespace App\Http\Controllers;

use App\Signature;
use Illuminate\Http\Request;

class SignatureController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
    }
    
    public function index()
    {
        $signatures = auth()->user()->signatures;

        return view('emails.signatures.index', compact('signatures'));

    }

    public function create()
    {
        return view('emails.signatures.create');
    }

    public function edit(Signature $signature)
    {
        return view('emails.signatures.edit', compact('signature'));
    }

    public function update(Signature $signature)
    {
        $attributes = request()->validate([
            'signature_title' => 'required',
            'name' => 'required',
            'position' => 'required',
        ]);

        $signature->update($attributes);

        return back();
    }

    public function store()
    {
        $attributes = request()->validate([
            'signature_title' => 'required',
            'name' => 'required',
            'position' => 'required',
        ]);

        auth()->user()->addSignature($attributes);

        return redirect('/signatures');
    }

    public function destroy(Signature $signature)
    {
        $signature->delete();
        return redirect('/signatures');
    }
}
