<?php

namespace App\Sections\Posts\Http\Requests;

use App\Http\Requests\Contracts\{
    IHasCountInput,
    IHasRelationsInput
};
use App\Http\Requests\Request;
use Illuminate\Support\Arr;
use App\Models\Post;

abstract class BasePostRequest extends Request implements IHasCountInput
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * Retreive request final inputs.
     *
     * @return array
     */
    public function inputs()
    {
        return $this->all();
    }

    /**
     * Request should have in query param count field, for pagination count limit, if it no present we should retreive default value.
     *
     * @return int
     */
    public function getCountInput()
    {
        $count = (int) Arr::get($this->query(), 'count', 30);
        return $count > 0 ? $count : 30;
    }

    /**
     * Request should have in query param relations field, for retreive resource relations, if it no present we should retreive default value.
     *
     * @return array
     */
    public function getRelationsInput()
    {
        $relations = (array) $this->input('relations', []);
        $post_relations = Post::$relationships;
        $result = [];
        foreach ($relations as $value) {
            if (in_array($value, $post_relations)) {
                $result[] = $value;
            }
        }
        return $result;
    }
}
