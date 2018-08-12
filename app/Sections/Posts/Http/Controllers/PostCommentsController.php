<?php

namespace App\Sections\Posts\Http\Controllers;

use App\Sections\Posts\Http\Requests\PostComments\{
    PostCommentRequest,
    PostCommentLikeableRequest
};
use App\Sections\Posts\Http\Responses\PostComments\{
    PostCommentResponse
};
use App\Http\Controllers\Controller;

class PostCommentsController extends Controller
{
    /**
     * Store a newly created post comment in storage.
     *
     * @param \App\Sections\Posts\Http\Requests\PostComments\PostCommentRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(PostCommentRequest $request)
    {
        $postCommentService = app('api.services.post-comments');
        $inputs = $request->inputs();
        $post_comment = $postCommentService->create($inputs);
        
        return new PostCommentResponse($post_comment, 201);
    }

    /**
     * Update the specified post comment in storage.
     *
     * @param \App\Sections\Posts\Http\Requests\PostComments\PostCommentRequest $request
     * @param string $id
     *
     * @return Response
     */
    public function update(PostCommentRequest $request, $id)
    {
        $postCommentService = app('api.services.post-comments');
        $postCommentService->abortIfNotExist($id);
        $inputs = $request->inputs();
        $postCommentService->update($id, $inputs);
        return response()->json(null, 204);
    }

    /**
     * Remove the specified post from storage.
     *
     * @param string $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $postCommentService = app('api.services.post-comments');
        $postCommentService->abortIfNotExist($id);
        $postCommentService->destroy($id);
        return response()->json(null, 204);
    }

    /**
     * Like or dislike the post.
     *
     * @param \App\Sections\Posts\Http\Requests\Posts\PostCommentLikeableRequest $request
     *
     * @return Response
     */
    public function addReaction(PostCommentLikeableRequest $request)
    {
        $postCommentService = app('api.services.post-comments');
        $inputs = $request->inputs();
        $postCommentService->createReaction($inputs);
        return response()->json(null, 204);
    }
}
