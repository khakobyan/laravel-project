<?php

namespace App\Sections\Posts\Contracts;

interface IPostCommentService
{
    /**
     * Create new post comment.
     *
     * @param array $inputs
     *
     * @return \App\Models\PostComment
     */
    public function create($inputs);

    /**
     * Update post comment.
     *
     * @param string $id
     * @param array  $inputs
     *
     * @return bool
     */
    public function update($id, $inputs);

    /**
     * Destroy post from storage.
     *
     * @param string $id
     *
     * @return bool
     */
    public function destroy($id);

    /**
     * Abort(404) if post comment not exist.
     *
     * @param string $id
     */
    public function abortIfNotExist($id);
}
