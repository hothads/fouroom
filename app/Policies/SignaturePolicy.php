<?php

namespace App\Policies;

use App\Signature;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SignaturePolicy
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
     * @param  \App\Signature $thread
     * @return mixed
     */
    public function update(User $user, Signature $signature)
    {
        return $signature->user_id == $user->id;
    }
}
