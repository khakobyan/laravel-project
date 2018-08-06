<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

abstract class BaseResponse implements Responsable
{
    /**
     * @var string
     */
    protected $view;

    protected $response_type = 'json';

    protected $status = 200;

    public function toResponse($request)
    {
        $data = $this->prepare();
        if ($request->wantsJson() || $request->ajax() || 'json' === $this->response_type) {
            return response()->json($data, $this->status);
        }
        return response()->view($this->view, $data);
    }

    abstract protected function prepare();
}
