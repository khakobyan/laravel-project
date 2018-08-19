<?php

namespace App\Sections\Trade\Services;

use App\Sections\Trade\Contracts\IProductService;
use App\Models\{
    Product
};

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
}
