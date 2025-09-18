<?php

namespace App\Http\Controllers\Api\Auth;


use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

use App\Http\Resources\ApiResponse;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\AdminRegisterRequest;
use App\Repositories\Contracts\AdminRepositoryInterface;

class AdminAuthController extends Controller
{
    protected $admin;

    public function __construct(AdminRepositoryInterface $admin)
    {
        $this->admin = $admin;
    }

    public function register(AdminRegisterRequest $request): JsonResponse
    {
        $admin = $this->admin->create($request->validated());
        return ApiResponse::success($admin, 'Admin registered', 201);
    }

    // public function login(AdminLoginRequest $request): JsonResponse
    // {
    //     $token = $this->admin->login($request->validated());

    //     if (! $token) {
    //         return ApiResponse::error('Invalid credentials', 401);
    //     }

    //     return ApiResponse::success(['token' => $token], 'Login successful');
    // }
}
