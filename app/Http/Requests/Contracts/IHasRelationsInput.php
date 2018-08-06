<?php

namespace App\Http\Requests\Contracts;

interface IHasRelationsInput
{
    /**
     * Request should have in query param relations field, for retreive resource relations, if it no present we should retreive default value.
     *
     * @return array
     */
    public function getRelationsInput();
}
