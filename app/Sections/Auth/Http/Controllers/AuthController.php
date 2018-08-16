<?php

namespace App\Sections\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SignupActivate;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Sections\Auth\Http\Requests\{
    AuthSignupRequest,
    AuthLoginRequest
};
use App\Sections\Auth\Http\Responses\{
    AuthActiveResponse,
    AuthLoginResponse
};
use DB, Exception;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param \App\Sections\Auth\Http\Requests\Posts\AuthSignupRequest $request
     * 
     * @return Response
     */
    public function signup(AuthSignupRequest $request)
    {
        try {
            DB::beginTransaction();

            $authService = app('api.services.auth');
            $inputs = $request->inputs();
            $authService->registerUser($inputs);

            DB::commit();
            return response()->json(['message' => 'Successfully created user!'], 201);
        } catch(Exception $e) {
            DB::rollback();
            return response()->json('Whoops, Something went wrong', 500);
        }
    }
    
    /**
     * Activate user
     *
     * @param string token
     * 
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function signupActivate($token)
    {
        $authService = app('api.services.auth');
        $user = $authService->activateUser($token);
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }

        return new AuthActiveResponse($user);
    }

    /**
     * Login user and create token
     *
     * @param \App\Sections\Auth\Http\Requests\Posts\AuthLoginRequest $request
     * 
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function login(AuthLoginRequest $request)
    {
        $authService = app('api.services.auth');
        $inputs = $request->inputs();
        $data = $authService->loginUser($inputs);
        
        return new AuthLoginResponse($data);
    }
  
    /**
     * Logout user
     *
     * @return Response
     */
    public function logout()
    {
        $authService = app('api.services.auth');
        $authService->logout();

        return response()->json(null, 204);
    }
}
