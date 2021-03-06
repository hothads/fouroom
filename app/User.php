<?php

namespace App;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Activity;
use App\Reply;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail); // my notification
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getRouteKeyName()
    {
        return 'name'; //user name
    }

    public function sendlogs()
    {
        return $this->hasMany(SendLog::class);
    }

    public function addSendLog($details)
    {
        $this->sendlogs()->create($details);
    }

    public function inviteKeys()
    {
        return $this->hasMany(InviteKey::class);
    }

    public function messageTemplates()
    {
      return $this->hasMany(MessageTemplate::class);
    }


    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }


    public function emaillists(){
        return $this->hasMany(EmailList::class);
    }


    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }


    public function activity(){
        return $this->hasMany(Activity::class);
    }


    public function visitedThreadCacheKey($thread)
    {
        return sprintf("users.%s.visits.%s", $this->id, $thread->id);
    }


    public function read($thread)
    {
        //simulate that the user visited the thred
        cache()->forever(
            $this->visitedThreadCacheKey($thread),
            Carbon::now()
        );
    }


    public function lastReply()
    {
        // in this case hase one will retun the last created reply
        return $this->hasOne(Reply::class)->latest();
    }


    public function getAvatarPathAttribute($avatar)
    {
        return $avatar ?:'avatars/default.jpg';
    }


    public function isAdmin()
    {
        return in_array($this->name, ['Mihail', 'santa']);
    }


    public function profilePath() {
        return '/profiles/' . $this->name;
    }


    public function addTemplate($attributes)
    {
        $this->messageTemplates()->create($attributes);
    }
    

    public function addSignature($attributes)
    {
        $this->signatures()->create($attributes);
    }

    public function addKey($attributes)
    {
        $attributes['key'] = Str::random(10);
        return $this->inviteKeys()->create($attributes);
    }



}
