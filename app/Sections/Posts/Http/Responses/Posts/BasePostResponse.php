<?php

namespace App\Sections\Posts\Http\Responses\Posts;

use App\Http\Responses\BaseResponse;
use stdclass;

abstract class BasePostResponse extends BaseResponse
{
    protected function formatSinglePost($post)
    {
        $relations = $post->relationsToArray();
        if (empty($relations)) {
            $relations = new stdclass();
        }
        $attributes = $post->attributesToArray();
        return array_merge($attributes, compact('relations'));
    }
}
