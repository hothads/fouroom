<?php

namespace App\Policies;

use App\EmailList;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailListPolicy
{
    use HandlesAuthorization;

        /**
     * Determine whether the user can update the thread.
     *
     * @param  \App\User  $user
     * @param  \App\EmailList  $thread
     * @return mixed
     */
    public function update(User $user, EmailList $list)
    {
        return $list->user_id == $user->id;
    }


}
