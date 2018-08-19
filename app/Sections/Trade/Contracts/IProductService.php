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

}
