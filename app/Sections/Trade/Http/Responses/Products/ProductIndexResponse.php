<?php

namespace App\Sections\Trade\Http\Responses\Products;

class ProductIndexResponse extends BaseProductResponse
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    protected function prepare()
    {
        $collection = $this->data->getCollection();
        $transformed = collect([]);
        $collection->each(function ($product) use ($transformed) {
            $transformed->push($this->formatSingleProduct($product));
        });
        $this->data->setCollection($transformed);
        return $this->data;
    }
}
