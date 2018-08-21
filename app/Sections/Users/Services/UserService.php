<?php

namespace App\Sections\Users\Services;

use App\Sections\Users\Contracts\IUserService;
use App\Models\{
    Post,
    PostComment,
    User,
    Product,
    ProductComment
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

    private function getAuthUser()
    {
        return User::where('id', Auth::id())->first();
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
        $user = $this->getAuthUser();

        switch ($inputs['type']) {
            case 'post':
                $item = Post::where('id', $inputs['id'])->first();
                break;
            case 'post-comment':
                $item = PostComment::where('id', $inputs['id'])->first();
                break;
            case 'product':
                $item = Product::where('id', $inputs['id'])->first();
                break;
            case 'product-comment':
                $item = ProductComment::where('id', $inputs['id'])->first();
                break;
        }

        if ($item && $user) {
            switch ($inputs['reaction']) {
                //Like item
                case 'like':
                    $user->like($item);
                    break;
                //Dislike item                    
                case 'dislike':
                    $user->dislike($item);
                    break;
                //Cancell like    
                case 'unlike':
                    $user->unlike($item);
                    break;
                //Cancell dislike    
                case 'undislike':
                    $user->undislike($item);
                    break;
            }
        }
        return false;
    }

    /**
     * Add,delete, accept, block friends.
     *
     * @param array $inputs
     *
     * @return bool
     */
    public function addFriends($inputs)
    {
        $user = $this->getAuthUser();
        $other_user = User::where('id', $inputs['id'])->first();
        // dd($user->id, $other_user->id);
        if ($other_user && $user) {
            switch ($inputs['request_type']) {
                //Send a Friend Request
                case 'befriend':
                    $user->befriend($other_user);
                    break;
                //Accept a Friend Request     
                case 'accept':
                    $user->acceptFriendRequest($other_user);
                    break;
                //Deny a Friend Request
                case 'deny':
                    $user->denyFriendRequest($other_user);
                    break;
                //Remove Friend
                case 'unfriend':
                    $user->unfriend($other_user);
                    break;
                //Block a Model
                case 'block':
                    $user->blockFriend($other_user);
                    break;
                //Unblock a Model
                case 'unblock':
                    $user->unblockFriend($other_user);
                    break; 
            }
        }
        return false;
    }

    /**
     * Add/delete friend to/from group.
     *
     * @param array $inputs
     *
     * @return bool
     */
    public function addToGroup($inputs)
    {
        $user = $this->getAuthUser();
        $friend = User::where('id', $inputs['id'])->first();
        
        if ($user->isFriendWith($friend) && ($friend && $user) && array_key_exists('group_name', $inputs)) {
            switch ($inputs['request_type']) {
                //Group a Friend
                case 'group':
                    $user->groupFriend($friend, $inputs['group_name']);
                    break;
                //Remove a Friend from a group
                case 'ungroup':
                    $user->ungroupFriend($friend, $inputs['group_name']);
                    break;
            }
        } elseif ($user->isFriendWith($friend) && ($friend && $user) && $inputs['request_type'] === 'ungroup_from_all'){
            //Remove a Friend from all groups 
            $user->ungroupFriend($friend);
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
