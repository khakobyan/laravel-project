<?php

namespace App\Sections\Posts\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class PostRequest extends Request
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
            'text' => 'string',
        ];
    }
    
    public function inputs()
    {
        return $this->all();
    }
}
