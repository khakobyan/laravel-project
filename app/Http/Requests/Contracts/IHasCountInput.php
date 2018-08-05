<?php

namespace App\Http\Requests\Contracts;

interface IHasCountInput
{
    /**
     * Request should have in query param count field, for pagination count limit, if it no present we should retreive default value.
     *
     * @return int
     */
    public function getCountInput();
}
