<?php

namespace App\Sections\Auth\Contracts;

interface IAuthService
{
    /**
     * Create new user.
     *
     * @param array $inputs
     *
     * @return \App\Models\User
     */
    public function registerUser($inputs);

    /**
     * Create new user.
     *
     * @param array $inputs
     *
     * @return \App\Models\User
     */
    public function activateUser($token);

    /**
     * Login user.
     *
     * @param array $inputs
     *
     * @return object $tokenResult
     */
    public function loginUser($inputs);

    /**
     * Logout.  (Revoke the token)
     *
     * @return void
     */
    public function logout();
}
