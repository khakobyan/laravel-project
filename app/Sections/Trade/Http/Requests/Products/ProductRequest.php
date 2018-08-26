<?php

namespace App\Sections\Trade\Http\Requests\Products;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
            'title' => 'required|string|max:500',
            'description' =>'string|max:2000',
            'price' => 'required|integer',
            'currency' => 'required|string|in:USD,EUR,AMD',
        ];
    }
    
    public function inputs()
    {
        return $this->all();
    }
}
