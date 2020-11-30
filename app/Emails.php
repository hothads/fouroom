<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    protected $guarded = [];

    public function emaillist()
    {
        return $this->belongsTo(EmailList::class,'email_list_id');
    }
}
