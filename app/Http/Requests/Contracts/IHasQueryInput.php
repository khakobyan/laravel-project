<?php

namespace App\Http\Requests\Contracts;

interface IHasQueryInput
{
    /**
     * Request should have in query param query field, for search filtration, if it no present we should retreive default value.
     *
     * @return array
     */
    public function getQueryInput();
}
