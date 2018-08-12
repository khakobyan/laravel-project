<?php

namespace App\Sections\Posts\Services;

use App\Sections\Posts\Contracts\IPostService;
use App\Models\{
    Post,
    User
};
use Auth;

class PostService implements IPostService
{
    /**
     * Get all posts.
     *
     * @param int $count
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll($count = 30, $relations = [])
    {
        $query = Post::query();
        if (!empty($relations)) {
            $query->with($relations);
        }
        return $query->orderBy('id')->paginate($count);
    }

    /**
     * Create new post.
     *
     * @param array $inputs
     *
     * @return \App\Models\Post
     */
    public function create($inputs)
    {
        $inputs['user_id'] = Auth::id();
        // $res = Post::with('user')->where('id', $post->id)->first();
        return Post::create($inputs); 
    }

    /**
     * Get post from storage.
     *
     * @param string $id
     * @param array  $relations
     *
     * @return \App\Models\Post
     */
    public function get($id, $relations = [])
    {
        $query = Post::where('id', $id);
        if (!empty($relations)) {
            $query = $query->with($relations);
        }
        return $query->first();
    }

    /**
     * Update post.
     *
     * @param string $id
     * @param array  $inputs
     *
     * @return bool
     */
    public function update($id, $inputs)
    {
        $post = Post::find($id);
        $inputs['user_id'] = Auth::id();
        if ($post && $post->user_id == $inputs['user_id']) {
            return $post->update($inputs);
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
        $post = Post::find($id);
        $inputs['user_id'] = Auth::id();
        if ($post && $post->user_id == $inputs['user_id']) {
            return $post->delete();
        }
        return false;
    }

    /**
     * Like or Dislike the post.
     *
     * @param array $inputs
     *
     * @return bool
     */
    public function createReaction($inputs)
    {
        $user = User::where('id', Auth::id())->first();
        $post = Post::where('id', $inputs['id'])->first();
        if ($post && $user) {
            switch ($inputs['reaction']) {
                case 'like':
                    $user->like($post);
                    break;
                case 'dislike':
                    $user->dislike($post);
                    break;
                case 'unlike':
                    $user->unlike($post);
                    break;
                case 'undislike':
                    $user->undislike($post);
                    break;
            }
        }
        return false;
    }

    /**
     * Abort(404) if post not exist.
     *
     * @param string $id
     */
    public function abortIfNotExist($id)
    {
        if (!Post::where('id', $id)->exists()) {
            abort(404, 'Not found');
        }
    }
}
