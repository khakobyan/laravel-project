<?php

namespace App\Sections\Users\Services;

use App\Sections\Users\Contracts\IUserService;
use App\Models\{
    Post,
    User
};
use Auth;

class UserService implements IUserService
{
    /**
     * Get all users.   !!!!! this is for future user searches with e.g. age, name, email etc. 
     *
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        $query = User::query();
        return $query->orderBy('id')->paginate(7);
    }

    /**
     * Like or Dislike by user.
     *
     * @param array $inputs
     *
     * @return bool
     */
    public function createReaction($inputs)
    {
        $user = User::where('id', Auth::id())->first();
        switch ($inputs['type']) {
            case 'post':
                $item = Post::where('id', $inputs['id'])->first();
                break;
            case 'post-comment':
                $item = PostComment::where('id', $inputs['id'])->first();
                break;
        }
        if ($item && $user) {
            switch ($inputs['reaction']) {
                case 'like':
                    $user->like($item);
                    break;
                case 'dislike':
                    $user->dislike($item);
                    break;
                case 'unlike':
                    $user->unlike($item);
                    break;
                case 'undislike':
                    $user->undislike($item);
                    break;
            }
        }
        return false;
    }

    // /**
    //  * Update post.
    //  *
    //  * @param string $id
    //  * @param array  $inputs
    //  *
    //  * @return bool
    //  */
    // public function update($id, $inputs)
    // {
    //     $post = Post::find($id);
    //     $inputs['user_id'] = Auth::id();
    //     if ($post && $post->user_id == $inputs['user_id']) {
    //         return $post->update($inputs);
    //     }
    //     return false;
    // }

    // /**
    //  * Destroy post from storage.
    //  *
    //  * @param string $id
    //  *
    //  * @return bool
    //  */
    // public function destroy($id)
    // {
    //     $post = Post::find($id);
    //     $inputs['user_id'] = Auth::id();
    //     if ($post && $post->user_id == $inputs['user_id']) {
    //         return $post->delete();
    //     }
    //     return false;
    // }

   

    // /**
    //  * Abort(404) if post not exist.
    //  *
    //  * @param string $id
    //  */
    // public function abortIfNotExist($id)
    // {
    //     if (!Post::where('id', $id)->exists()) {
    //         abort(404, 'Not found');
    //     }
    // }
}
