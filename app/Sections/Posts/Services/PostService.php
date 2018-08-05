<?php

namespace App\Sections\Posts\Services;

use App\Sections\Posts\Contracts\IPostService;
use App\Models\Post;

class PostService implements IPostService
{
    /**
     * Get all posts.
     *
     * @param int $count
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll($count = 30)
    {
        return Post::orderBy('id')->paginate($count);
    }

    // /**
    //  * Create new tag.
    //  *
    //  * @param array $inputs
    //  *
    //  * @return \App\ModelsV2\Sites\Tag
    //  */
    // public function create($inputs)
    // {
    //     return Tag::firstOrCreate($inputs);
    // }

    // /**
    //  * Update tag.
    //  *
    //  * @param string $id
    //  * @param array  $inputs
    //  *
    //  * @return bool
    //  */
    // public function update($id, $inputs)
    // {
    //     $row = Tag::find($id);
    //     if ($row) {
    //         return $row->update($inputs);
    //     }
    //     return false;
    // }

    // /**
    //  * Destroy tag from storage.
    //  *
    //  * @param string $id
    //  *
    //  * @return bool
    //  */
    // public function destroy($id)
    // {
    //     $row = Tag::find($id);
    //     if ($row) {
    //         return $row->delete();
    //     }
    //     return false;
    // }

    // /**
    //  * Abort(404) if tag not exist.
    //  *
    //  * @param string $id
    //  */
    // public function abortIfNotExist($id)
    // {
    //     if (!Tag::where('id', $id)->exists()) {
    //         abort(404, 'Not found');
    //     }
    // }
}
