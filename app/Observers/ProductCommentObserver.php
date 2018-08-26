<?php

namespace App\Observers;

use App\Models\ProductComment;
use Auth;

class ProductCommentObserver
{
    /**
     * Handle the product comment "created" event.
     *
     * @param  \App\Models\ProductComment  $comment
     * @return void
     */
    public function creating(ProductComment $comment)
    {
        $comment->user_id = Auth::id();
    }

    /**
     * Handle the product comment "updated" event.
     *
     * @param  \App\Models\ProductComment  $comment
     * @return void
     */
    public function saving(ProductComment $comment)
    {
        if (null === $comment->user_id || '' === $comment->user_id) {
            $comment->user_id = Auth::id();
        }
    }
}
