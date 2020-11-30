<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailList extends Model
{
    protected $guarded=[];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function emails()
    {
        return $this->hasMany(Emails::class);
    }

    public function addEmail($emaillist)
    {
        return $this->emails()->create($emaillist);
    }

    public function path()
    {
        return "/lists/$this->id/emails/create";
    }
}
