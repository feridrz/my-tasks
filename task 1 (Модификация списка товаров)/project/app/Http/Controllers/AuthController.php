<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if($validator->fails()){
            return $this->errorResponse('Validation Error', $validator->errors(), 409);
        }

        $validatedData = $validator->validated();

        $user = $this->userService->createUser($validatedData);

        $token = JWTAuth::fromUser($user);

        return $this->successResponse(compact('user','token'), 'User registered successfully');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->errorResponse('Invalid Credentials');
            }
        } catch (JWTException $e) {
            return $this->errorResponse('Could not create token');
        }

        return $this->successResponse(compact('token'), 'Logged in successfully');
    }
}
