<?php

namespace App\Sections\Trade\Http\Controllers;

use App\Sections\Trade\Http\Requests\Products\{
    ProductIndexRequest,
    ProductRequest,
    ProductShowRequest
};
use App\Sections\Trade\Http\Responses\Products\{
    ProductIndexResponse,
    ProductResponse    
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
        $count = $request->getCountInput(true);
        $relations = $request->getRelationsInput();
        $query = $request->getQueryInput();
        $sort_by = $request->getSortByInput();
        $products = $productService->getAll($count, $relations, $query, $sort_by);
        
        return new ProductIndexResponse($products);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param App\Sections\Trade\Http\Requests\Products\ProductRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(ProductRequest $request)
    {
        $productService = app('api.services.products');
        $inputs = $request->inputs();
        $product = $productService->create($inputs);
        return new ProductResponse($product, 201);
    }

    /**
     * Get product from storage.
     *
     * @param App\Sections\Trade\Http\Requests\Products\ProductShowRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function show(ProductShowRequest $request, $id)
    {
        $productService = app('api.services.products');
        $relations = $request->getRelationsInput();
        $productService->abortIfNotExist($id);
        $product = $productService->get($id, $relations);
        return new ProductResponse($product);
    }

    /**
     * Update the specified product in storage.
     *
     * @param App\Sections\Trade\Http\Requests\Products\ProductRequest $request
     * @param string $id
     *
     * @return Response
     */
    public function update(ProductRequest $request, $id)
    {
        $productService = app('api.services.products');
        $inputs = $request->inputs();
        $productService->update($id, $inputs);
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
        $productService = app('api.services.products');
        $productService->destroy($id);
        return response()->json(null, 204);
    }
}
