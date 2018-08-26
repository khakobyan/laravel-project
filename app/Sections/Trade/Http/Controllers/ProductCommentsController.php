<?php

namespace App\Sections\Trade\Http\Controllers;

use App\Sections\Trade\Http\Requests\ProductComments\{
    ProductCommentRequest
};
use App\Sections\Trade\Http\Responses\ProductComments\{
    ProductCommentResponse
};
use App\Http\Controllers\Controller;

class ProductCommentsController extends Controller
{
    /**
     * Store a newly created product comment in storage.
     *
     * @param \App\Sections\Trade\Http\Requests\ProductComments\ProductCommentRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(ProductCommentRequest $request)
    {
        $productCommentService = app('api.services.product-comments');
        $inputs = $request->inputs();
        $product_comment = $productCommentService->create($inputs);
        
        return new ProductCommentResponse($product_comment, 201);
    }

    /**
     * Update the specified product comment in storage.
     *
     * @param \App\Sections\Trade\Http\Requests\ProductComments\ProductCommentRequest $request
     * @param string $id
     *
     * @return Response
     */
    public function update(ProductCommentRequest $request, $id)
    {
        $productCommentService = app('api.services.product-comments');
        $productCommentService->abortIfNotExist($id);
        $inputs = $request->inputs();
        $productCommentService->update($id, $inputs);
        return response()->json(null, 204);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param string $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productCommentService = app('api.services.product-comments');
        $productCommentService->abortIfNotExist($id);
        $productCommentService->destroy($id);
        return response()->json(null, 204);
    }
}
