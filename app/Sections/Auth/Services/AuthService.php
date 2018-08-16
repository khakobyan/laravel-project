<?php

namespace App\Sections\Auth\Services;

use App\Sections\Auth\Contracts\IAuthService;
use App\Models\User;
use App\Notifications\SignupActivate;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuthService implements IAuthService
{
    /**
     * Create new user.
     *
     * @param array $inputs
     *
     * @return \App\Models\User
     */
    public function registerUser($inputs)
    {
        $inputs['password'] = bcrypt($inputs['password']);
        $inputs['activation_token'] = str_random(60);
        $user = User::create($inputs);
        $user->save();
        $user->notify(new SignupActivate($user));
    }

    /**
     * Create new user.
     *
     * @param array $inputs
     *
     * @return \App\Models\User
     */
    public function activateUser($token)
    {
        $user = User::where('activation_token', $token)->first();
        if ($user) {
            $user->active = true;
            $user->activation_token = '';
            $user->save();
            return $user;
        }
        return false;
    }

    /**
     * Login user.
     *
     * @param array $inputs
     *
     * @return object $tokenResult
     */
    public function loginUser($inputs)
    {
        $credentials['email'] = $inputs['email'];
        $credentials['password'] = $inputs['password'];
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
        
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = Auth::user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        
        if (array_key_exists('remember_me', $inputs) && $inputs['remember_me']) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        } else {
            $token->expires_at = Carbon::now()->addDays(1);
        }  

        $token->save();

        return $tokenResult;
    }

    /**
     * Logout.  (Revoke the token)
     *
     * @return void
     */
    public function logout()
    {
        return Auth::user()->token()->revoke();
    }
}
