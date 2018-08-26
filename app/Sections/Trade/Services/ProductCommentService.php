<?php

namespace App\Sections\Trade\Services;

use App\Sections\Trade\Contracts\IProductCommentService;
use App\Models\{
    ProductComment,
    Product
};
use Auth;

class ProductCommentService implements IProductCommentService
{
    /**
     * Create new product comment.
     *
     * @param array $inputs
     *
     * @return \App\Models\ProductComment
     */
    public function create($inputs)
    {
        Product::findOrFail($inputs['product_id']);
        return ProductComment::create($inputs); 
    }

    /**
     * Update product comment.
     *
     * @param string $id
     * @param array  $inputs
     *
     * @return bool
     */
    public function update($id, $inputs)
    {
        $productComment = ProductComment::find($id);
        if ($productComment && $productComment->user_id == Auth::id()) {
            return $productComment->update($inputs);
        }
        return false;
    }

    /**
     * Delete product from storage.
     *
     * @param string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $productComment = ProductComment::find($id);
        if ($productComment && $productComment->user_id == Auth::id()) {
            return $productComment->delete();
        }
        return false;
    }

    /**
     * Abort(404) if product comment not exist.
     *
     * @param string $id
     */
    public function abortIfNotExist($id)
    {
        if (!ProductComment::where('id', $id)->exists()) {
            abort(404, 'Not found');
        }
    }
}
