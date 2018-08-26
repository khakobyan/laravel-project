<?php

namespace App\Sections\Trade\Http\Responses\ProductComments;

use App\Http\Responses\BaseResponse;

class ProductCommentResponse extends BaseResponse
{
    public function __construct($data, $status = 200)
    {
        $this->data = $data;
        $this->status = $status;
    }

    protected function prepare()
    {
        return $this->data;
    }
}
