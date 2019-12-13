<?php

namespace App\Observers;

use App\Models\Post;
use App\Observers\BaseObserver;

class PostObserver extends BaseObserver
{
    /**
     * Handle the model "saving" event.
     *
     * @return void
     */
    public function saving($post)
    {
        parent::saving($post);
    }
    /**
     * Handle the model "saved" event.
     *
     * @return void
     */
    public function saved($post)
    {
        
    }
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created($post)
    {
        parent::created($post);
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated($post)
    {
        //
    }

    /**
     * Handle the post "deleting" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleting($post)
    {
        parent::deleting($post);
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted($post)
    {

    }

    /**
     * Handle the post "restored" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function restored($post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function forceDeleted($post)
    {
        //
    }
}
