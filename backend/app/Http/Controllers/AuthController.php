<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInUserRequest;
use App\Http\Requests\SignUpUserRequest;
use App\Services\User\UserService;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class AuthController extends Controller
{
    /** @var UserService $userService */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function signUp(SignUpUserRequest $request)
    {
       $this->userService->createUser([
           'email' => $request->get('email'),
           'password' => bcrypt($request->get('password'))
       ]);

       return response()->json([
           'status' => true,
           'message' => "Congrats! you are successfully registered"
       ], 200);
    }

    public function signIn(SignInUserRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            throw new UserNotDefinedException();
        }

        return response()->json(['status' => true, 'token' => $token ], 200);
    }
}