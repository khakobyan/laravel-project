<?php

namespace App\Sections\Posts\Http\Responses\PostComments;

use App\Http\Responses\BaseResponse;

class PostCommentResponse extends BaseResponse
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
