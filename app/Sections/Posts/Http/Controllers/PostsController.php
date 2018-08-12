<?php

namespace App\Sections\Posts\Http\Controllers;

use App\Sections\Posts\Http\Requests\Posts\{
    PostIndexRequest,
    PostRequest,
    PostShowRequest,
    PostLikeableRequest
};
use App\Sections\Posts\Http\Responses\Posts\{
    PostIndexResponse,
    PostResponse
};
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @param App\Sections\Posts\Http\Requests\Posts\PostIndexRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function index(PostIndexRequest $request)
    {
        $postService = app('api.services.posts');
        $count = $request->getCountInput();
        $relations = $request->getRelationsInput();
        $posts = $postService->getAll($count, $relations);
       
        return new PostIndexResponse($posts);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param \App\Sections\Posts\Http\Requests\Posts\PostRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(PostRequest $request)
    {
        $postService = app('api.services.posts');
        $inputs = $request->inputs();
        $post = $postService->create($inputs);
        return new PostResponse($post, 201);
    }

    /**
     * Get post from storage.
     *
     * @param \App\Sections\Posts\Http\Requests\Posts\PostShowRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function show(PostShowRequest $request, $id)
    {
        $postService = app('api.services.posts');
        $relations = $request->getRelationsInput();
        $postService->abortIfNotExist($id);
        $post = $postService->get($id, $relations);
        return new PostResponse($post);
    }

    /**
     * Update the specified post in storage.
     *
     * @param \App\Sections\Posts\Http\Requests\Posts\PostRequest $request
     * @param string $id
     *
     * @return Response
     */
    public function update(PostRequest $request, $id)
    {
        $postService = app('api.services.posts');
        $postService->abortIfNotExist($id);
        $inputs = $request->inputs();
        $postService->update($id, $inputs);
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
        $postService = app('api.services.posts');
        $postService->abortIfNotExist($id);
        $postService->destroy($id);
        return response()->json(null, 204);
    }

    /**
     * Like or dislike the post.
     *
     * @param \App\Sections\Posts\Http\Requests\Posts\PostLikeableRequest $request
     *
     * @return Response
     */
    public function addReaction(PostLikeableRequest $request)
    {
        $postService = app('api.services.posts');
        $inputs = $request->inputs();
        $postService->createReaction($inputs);
        return response()->json(null, 204);
    }
}
