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

    // /**
    //  * Create new tag.
    //  *
    //  * @param array $inputs
    //  *
    //  * @return \App\ModelsV2\Sites\Tag
    //  */
    // public function create($inputs);

    // /**
    //  * Update tag.
    //  *
    //  * @param string $id
    //  * @param array  $inputs
    //  *
    //  * @return bool
    //  */
    // public function update($id, $inputs);

    // /**
    //  * Destroy tag from storage.
    //  *
    //  * @param string $id
    //  *
    //  * @return bool
    //  */
    // public function destroy($id);

    // /**
    //  * Abort(404) if video collection not exist.
    //  *
    //  * @param string $id
    //  */
    // public function abortIfNotExist($id);
}
