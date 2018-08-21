<?php

namespace App\Sections\Trade\Services;

use App\Sections\Trade\Contracts\IProductService;
use App\Models\{
    Product
};
use Auth;

class ProductService implements IProductService
{
    /**
     * Get all products.
     *
     * @param int $count
     * @param array $relations
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll($count = 30, $relations = [])
    {
        $query = Product::query();
        if (!empty($relations)) {
            $query->with($relations);
        }
        return $query->orderBy('id')->paginate($count);
    }

    /**
     * Create new product.
     *
     * @param array $inputs
     *
     * @return \App\Models\Product
     */
    public function create($inputs)
    {
        return Product::create($inputs); 
    }

    /**
     * Get product from storage.
     *
     * @param string $id
     * @param array  $relations
     *
     * @return \App\Models\Post
     */
    public function get($id, $relations = [])
    {
        $query = Product::where('id', $id);
        if (!empty($relations)) {
            $query = $query->with($relations);
        }
        return $query->first();
    }

    /**
     * Update product.
     *
     * @param string $id
     * @param array  $inputs
     *
     * @return bool
     */
    public function update($id, $inputs)
    {
        $product = Product::findOrFail($id);
        if ($product && $product->user_id == Auth::id()) {
            return $product->update($inputs);
        }
        return false;
    }

    /**
     * Destroy product from storage.
     *
     * @param string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product && $product->user_id == Auth::id()) {
            return $product->delete();
        }
        return false;
    }

    /**
     * Abort(404) if product not exist.
     *
     * @param string $id
     */
    public function abortIfNotExist($id)
    {
        if (!Product::where('id', $id)->exists()) {
            abort(404, 'Not found');
        }
    }
}
