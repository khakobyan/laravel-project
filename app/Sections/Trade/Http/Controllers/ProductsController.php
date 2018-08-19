<?php

namespace App\Sections\Trade\Http\Controllers;

use App\Sections\Trade\Http\Requests\Products\{
    ProductIndexRequest
};
use App\Sections\Trade\Http\Responses\Products\{
    ProductIndexResponse    
};
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @param App\Sections\Trade\Http\Requests\Products\ProductIndexRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function index(ProductIndexRequest $request)
    {
        $productService = app('api.services.products');
        $count = $request->getCountInput();
        $relations = $request->getRelationsInput();
        $products = $productService->getAll($count, $relations);
        
        return new ProductIndexResponse($products);
    }

    // /**
    //  * Store a newly created post in storage.
    //  *
    //  * @param \App\Sections\Posts\Http\Requests\Posts\PostRequest $request
    //  *
    //  * @return \Illuminate\Contracts\Support\Responsable
    //  */
    // public function store(PostRequest $request)
    // {
    //     $postService = app('api.services.posts');
    //     $inputs = $request->inputs();
    //     $post = $postService->create($inputs);
    //     return new PostResponse($post, 201);
    // }

    // /**
    //  * Get post from storage.
    //  *
    //  * @param \App\Sections\Posts\Http\Requests\Posts\PostShowRequest $request
    //  *
    //  * @return \Illuminate\Contracts\Support\Responsable
    //  */
    // public function show(PostShowRequest $request, $id)
    // {
    //     $postService = app('api.services.posts');
    //     $relations = $request->getRelationsInput();
    //     $postService->abortIfNotExist($id);
    //     $post = $postService->get($id, $relations);
    //     return new PostResponse($post);
    // }

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
