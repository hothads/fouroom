<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Activity;
use App\SendLog;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        $activities = Activity::feed($user);
        
        $sendlogs = SendLog::feed($user);

    	return view('profiles.show', compact('user', 'activities', 'sendlogs'));
    }

}
