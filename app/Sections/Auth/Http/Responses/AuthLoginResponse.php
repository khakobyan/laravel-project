<?php

namespace App\Sections\Auth\Http\Responses;

use App\Http\Responses\BaseResponse;
use Carbon\Carbon;

class AuthLoginResponse extends BaseResponse
{
    public function __construct($data, $status = 200)
    {
        $this->data = $data;
        $this->status = $status;
    }

    protected function prepare()
    {
        return [
            'access_token' => $this->data->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($this->data->token->expires_at)->toDateTimeString()
        ];
    }
}
