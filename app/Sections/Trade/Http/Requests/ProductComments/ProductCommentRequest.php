<?php

namespace App\Sections\Trade\Http\Requests\ProductComments;

use App\Http\Requests\Request;

class ProductCommentRequest extends Request
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
            'text' => 'required|string',
            'product_id' => 'required|int'
        ];
    }
    
    public function inputs()
    {
        return $this->all();
    }
}
