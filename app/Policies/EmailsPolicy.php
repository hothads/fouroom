<?php

namespace App\Policies;

use App\EmailList;
use App\Emails;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

            /**
     * Determine whether the user can update the thread.
     *
     * @param  \App\User  $user
     * @param  \App\Emails  $thread
     * @return mixed
     */
    public function update(User $user, Emails $email)
    {
        return $email->emaillist->owner->id == $user->id;
    }

}
