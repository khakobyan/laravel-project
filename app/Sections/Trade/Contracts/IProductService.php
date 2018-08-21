<?php

namespace App\Sections\Trade\Contracts;

interface IProductService
{
    /**
     * Get all products.
     *
     * @param int $count
     * @param array $relations
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll($count = 30, $relations = []);

    /**
     * Create new product.
     *
     * @param array $inputs
     *
     * @return \App\Models\Product
     */
    public function create($inputs);

    /**
     * Get product from storage.
     *
     * @param string $id
     * @param array  $relations
     *
     * @return \App\Models\Post
     */
    public function get($id, $relations = []);
    
    /**
     * Update product.
     *
     * @param string $id
     * @param array  $inputs
     *
     * @return bool
     */
    public function update($id, $inputs);

    /**
     * Destroy product from storage.
     *
     * @param string $id
     *
     * @return bool
     */
    public function destroy($id);

    /**
     * Abort(404) if product not exist.
     *
     * @param string $id
     */
    public function abortIfNotExist($id);
}
