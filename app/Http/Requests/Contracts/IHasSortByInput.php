<?php

namespace App\Http\Requests\Contracts;

interface IHasSortByInput
{
    /**
     * Request sort by ascending or descending lists, if it no present we should retreive default value.
     *
     * @return array
     */
    public function getSortByInput();
}
