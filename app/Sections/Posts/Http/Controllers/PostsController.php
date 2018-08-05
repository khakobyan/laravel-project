<?php

namespace App\Sections\Posts\Http\Controllers;

use App\Sections\Posts\Http\Requests\PostIndexRequest;
// use Ams\Api\V2\Tags\Http\Requests\TagRequest;
// use Ams\Api\V2\Tags\Http\Responses\TagIndexResponse;
// use Ams\Api\V2\Tags\Http\Responses\TagResponse;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the tags.
     *
     * @param \Ams\Api\V2\Tags\Http\Requests\PostIndexRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function index(PostIndexRequest $request)
    {
        $postService = app('api.services.posts');
        $count = $request->getCountInput();
        $posts = $postService->getAll($count);
        return $posts;
        // return new TagIndexResponse($tags);
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param \Ams\Api\V2\Tags\Http\Requests\TagRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(TagRequest $request)
    {
        $tagService = app('api.services.tags');
        $inputs = $request->inputs();
        $tag = $tagService->create($inputs);
        return new TagResponse($tag, 201);
    }

    /**
     * Update the specified tag in storage.
     *
     * @param \Ams\Api\V2\Tags\Http\Requests\TagRequest $request
     * @param string                                    $id
     *
     * @return Response
     */
    public function update(TagRequest $request, $id)
    {
        $tagService = app('api.services.tags');
        $tagService->abortIfNotExist($id);
        $inputs = $request->inputs();
        $tag = $tagService->update($id, $inputs);
        return response()->json(null, 204);
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param string $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tagService = app('api.services.tags');
        $tagService->abortIfNotExist($id);
        $tagService->destroy($id);
        return response()->json(null, 204);
    }
}
