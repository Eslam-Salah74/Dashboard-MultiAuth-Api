<?php

namespace App\Http\Controllers\Api\Auth;

use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use App\Http\Resources\ApiResponse;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\AdminRegisterRequest;

class AdminAuthController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function register(AdminRegisterRequest $request)
    {
        // return response()->json($request);
        $admin = $this->adminService->create($request->validated());

        return ApiResponse::success($admin, 'Admin registered successfully', 201);
    }

    public function login(AdminLoginRequest $request)
    {
        $token = $this->adminService->login($request->validated());

        if (! $token) {
            return ApiResponse::error('Invalid credentials', 401);
        }

        return ApiResponse::success(['token' => $token], 'Login successful');
    }
}
