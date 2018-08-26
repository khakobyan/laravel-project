<?php

namespace App\Sections\Trade\Http\Responses\Products;

class ProductResponse extends BaseProductResponse
{
    public function __construct($data, $status = 200)
    {
        $this->data = $data;
        $this->status = $status;
    }

    protected function prepare()
    {
        return $this->formatSingleProduct($this->data);
    }
}
