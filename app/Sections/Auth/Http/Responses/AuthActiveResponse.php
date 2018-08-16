<?php

namespace App\Sections\Auth\Http\Responses;

use App\Http\Responses\BaseResponse;

class AuthActiveResponse extends BaseResponse
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
