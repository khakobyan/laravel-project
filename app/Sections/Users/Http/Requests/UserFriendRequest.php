<?php

namespace App\Sections\Users\Http\Requests;

use App\Http\Requests\Request;

class UserFriendRequest extends Request
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
            'request_type' => 'required|string|in:befriend,accept,deny,unfriend,block,unblock,',
            'id' => 'required|string',
        ];
    }
    
    public function inputs()
    {
        return $this->all();
    }
}
