<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SendLog extends Model
{
    protected $guarded=[];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    static function feed($user, $take=50){
        return static::where(['user_id'=>$user->id])
            ->latest()
            ->take($take)
            ->get()
            ->groupBy(function ($sendlog) {
            return $sendlog->created_at->format('d.m.Y');
        });
    }
}
