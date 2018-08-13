<?php

namespace App\Sections\Users\Contracts;

interface IUserService
{
    /**
     * Get all users.   !!!!! this is for future user searches with e.g. age, name, email etc. 
     *
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll();

    /**
     * Like or Dislike by user.
     *
     * @param array $inputs
     *
     * @return bool
     */
    public function createReaction($inputs);
}
