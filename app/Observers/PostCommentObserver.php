<?php

namespace App\Observers;

use App\Models\PostComment;
use Auth;

class PostCommentObserver
{
    /**
     * Handle the post comment "created" event.
     *
     * @param  \App\Models\PostComment  $comment
     * @return void
     */
    public function creating(PostComment $comment)
    {
        $comment->user_id = Auth::id();
    }

    /**
     * Handle the post comment "updated" event.
     *
     * @param  \App\Models\PostComment  $comment
     * @return void
     */
    public function saving(PostComment $comment)
    {
        if (null === $comment->user_id || '' === $comment->user_id) {
            $comment->user_id = Auth::id();
        }
    }
}
