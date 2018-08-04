<?php

namespace App\Observers;

use App\User;
use Webpatser\Uuid\Uuid;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->uuid = Uuid::generate(4)->string;
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function saving(User $user)
    {
        if (null === $user->uuid || '' === $user->uuid) {
            $user->uuid = Uuid::generate(4)->string;
        }
    }
}
