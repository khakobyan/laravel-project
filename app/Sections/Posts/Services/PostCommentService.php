<?php

namespace App\Sections\Posts\Services;

use App\Sections\Posts\Contracts\IPostCommentService;
use App\Models\{
    PostComment,
    Post
};
use Auth;

class PostCommentService implements IPostCommentService
{
    /**
     * Create new post comment.
     *
     * @param array $inputs
     *
     * @return \App\Models\PostComment
     */
    public function create($inputs)
    {
        Post::findOrFail($inputs['post_id']);
        return PostComment::create($inputs); 
    }

    /**
     * Update post comment.
     *
     * @param string $id
     * @param array  $inputs
     *
     * @return bool
     */
    public function update($id, $inputs)
    {
        $postComment = PostComment::find($id);
        if ($postComment && $postComment->user_id == Auth::id()) {
            return $postComment->update($inputs);
        }
        return false;
    }

    /**
     * Destroy post from storage.
     *
     * @param string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $postComment = PostComment::find($id);
        if ($postComment && $postComment->user_id == Auth::id()) {
            return $postComment->delete();
        }
        return false;
    }

    /**
     * Abort(404) if post comment not exist.
     *
     * @param string $id
     */
    public function abortIfNotExist($id)
    {
        if (!PostComment::where('id', $id)->exists()) {
            abort(404, 'Not found');
        }
    }
}
