<?php

namespace App\Sections\Users\Http\Requests;

use App\Http\Requests\Request;

class UserFriendGroupRequest extends Request
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
            'request_type' => 'required|string|in:group,ungroup,ungroup_from_all',
            'group_name' => 'string|in:acquaintances,close_friends,family,work',
            'id' => 'required|string',
        ];
    }
    
    public function inputs()
    {
        return $this->all();
    }
}
