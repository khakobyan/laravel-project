<?php

namespace App\Sections\Posts\Contracts;

interface IPostService
{
    /**
     * Get all tags.
     *
     * @param int $count
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll($count = 30);

    /**
     * Create new post.
     *
     * @param array $inputs
     *
     * @return \App\Models\Post
     */
    public function create($inputs);

    /**
     * Update post.
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
     * Abort(404) if post not exist.
     *
     * @param string $id
     */
    public function abortIfNotExist($id);
}
