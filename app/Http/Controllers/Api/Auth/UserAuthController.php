<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ApiResponse;

class UserAuthController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = $this->userService->register($request->validated());
        return ApiResponse::success($user, 'User registered', 201);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $token = $this->userService->login($request->validated());

        if (! $token) {
            return ApiResponse::error('Invalid credentials', 401);
        }

        return ApiResponse::success(['token' => $token], 'Login successful');
    }
}
