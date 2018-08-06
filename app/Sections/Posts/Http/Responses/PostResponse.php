<?php

namespace App\Sections\Posts\Http\Responses;

class PostResponse extends BasePostResponse
{
    public function __construct($data, $status = 200)
    {
        $this->data = $data;
        $this->status = $status;
    }

    protected function prepare()
    {
        return $this->formatSinglePost($this->data);
    }
}
