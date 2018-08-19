<?php

namespace App\Sections\Trade\Http\Responses\Products;

use App\Http\Responses\BaseResponse;
use stdclass;

abstract class BaseProductResponse extends BaseResponse
{
    protected function formatSingleProduct($product)
    {
        $relations = $product->relationsToArray();
        if (empty($relations)) {
            $relations = new stdclass();
        }
        $attributes = $product->attributesToArray();
        return array_merge($attributes, compact('relations'));
    }
}
