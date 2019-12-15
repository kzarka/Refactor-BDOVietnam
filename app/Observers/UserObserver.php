<?php

namespace App\Observers;

use App\Models\User;
use App\Observers\BaseObserver;

class UserObserver extends BaseObserver
{
    /**
     * Handle the model "saving" event.
     *
     * @return void
     */
    public function saving($user)
    {
        parent::saving($user);
    }
    /**
     * Handle the model "saved" event.
     *
     * @return void
     */
    public function saved($user)
    {
        
    }
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created($user)
    {
        parent::created($user);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated($user)
    {
        //
    }

    /**
     * Handle the user "deleting" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting($user)
    {
        parent::deleting($user);
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted($user)
    {
        
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored($user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted($user)
    {
        //
    }
}
