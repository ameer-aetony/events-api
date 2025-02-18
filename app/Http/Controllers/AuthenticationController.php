<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function __construct(private readonly UserService $userService) {}
    public function register(RegisterUserRequest $request)
    {
        $user = $this->userService->register($request);
        return $this->sendSuccess(['user' => $user], 'Restoration success');
    }

    public function login(LoginRequest $request)
    {
       $result = $this->userService->login($request);
        return $this->sendSuccess([
            'user' => $result['user'],
            'token' =>$result['token']
        ], 'Log in successfully');
    }

    public function user(Request $request)
    {
        return $this->sendSuccess([
            'user' => $request->user(),
        ], 'Authenticated user retrieved');
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return $this->sendSuccess([], 'Logged out successfully');
    }
}
