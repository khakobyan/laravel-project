<?php

namespace App\Observers;

use App\Models\Post;
use Auth;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->user_id = Auth::id();
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function saving(Post $post)
    {
        if (null === $post->user_id || '' === $post->user_id) {
            $post->user_id = Auth::id();
        }
    }
}
