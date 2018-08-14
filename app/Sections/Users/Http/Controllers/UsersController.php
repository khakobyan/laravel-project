<?php

namespace App\Sections\Users\Http\Controllers;

use App\Sections\Users\Http\Requests\{
    UserLikeRequest,
    UserFriendRequest,
    UserFriendGroupRequest
};
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function index()
    {
        $userService = app('api.services.users');
        $users = $userService->getAll();
       
        return $users;
    }

    /**
     * Like or dislike items by user.
     *
     * @param \App\Sections\Users\Http\Requests\UserLikeRequest $request
     *
     * @return Response
     */
    public function addReaction(UserLikeRequest $request)
    {
        $userService = app('api.services.users');
        $inputs = $request->inputs();
        $userService->createReaction($inputs);
        return response()->json(null, 204);
    }

    /**
     * Add friends
     *
     * @param \App\Sections\Users\Http\Requests\UserFriendRequest $request
     *
     * @return Response
     */
    public function addFriend(UserFriendRequest $request)
    {
        $userService = app('api.services.users');
        $inputs = $request->inputs();
        $userService->addFriends($inputs);
        return response()->json(null, 204);
    }

    /**
     * Add friend to specific group
     *
     * @param \App\Sections\Users\Http\Requests\UserFriendGroupRequest $request
     *
     * @return Response
     */
    public function addFriendToGroup(UserFriendGroupRequest $request)
    {
        $userService = app('api.services.users');
        $inputs = $request->inputs();
        $userService->addToGroup($inputs);
        return response()->json(null, 204);
    }

    // /**
    //  * Update the specified post in storage.
    //  *
    //  * @param \App\Sections\Posts\Http\Requests\Posts\PostRequest $request
    //  * @param string $id
    //  *
    //  * @return Response
    //  */
    // public function update(PostRequest $request, $id)
    // {
    //     $postService = app('api.services.posts');
    //     $postService->abortIfNotExist($id);
    //     $inputs = $request->inputs();
    //     $postService->update($id, $inputs);
    //     return response()->json(null, 204);
    // }

    // /**
    //  * Remove the specified post from storage.
    //  *
    //  * @param string $id
    //  *
    //  * @return Response
    //  */
    // public function destroy($id)
    // {
    //     $postService = app('api.services.posts');
    //     $postService->abortIfNotExist($id);
    //     $postService->destroy($id);
    //     return response()->json(null, 204);
    // }
}
