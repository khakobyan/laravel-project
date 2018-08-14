<?php

namespace App\Sections\Users\Http\Requests;

use App\Http\Requests\Request;

class UserLikeRequest extends Request
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
            'reaction' => 'required|string|in:like,dislike,unlike,undislike',
            'id' => 'required|int',
            'type' => 'required|string|in:post,post-comment',
        ];
    }
    
    public function inputs()
    {
        return $this->all();
    }
}
