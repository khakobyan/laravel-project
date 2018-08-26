<?php

namespace App\Sections\Posts\Http\Responses\Posts;

class PostIndexResponse extends BasePostResponse
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    protected function prepare()
    {
        $collection = $this->data->getCollection();
        $transformed = collect([]);
        $collection->each(function ($post) use ($transformed) {
            $transformed->push($this->formatSinglePost($post));
        });
        $this->data->setCollection($transformed);
        return $this->data;
    }
}
