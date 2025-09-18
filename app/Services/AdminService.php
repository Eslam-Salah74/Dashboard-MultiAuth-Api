<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\AdminRepositoryInterface;

class AdminService implements AdminServiceInterface
{
    protected  $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function register(array $data): Admin
    {
        Log::info($data);
        $data['password'] = Hash::make($data['password']);
        $admin = $this->adminRepository->create($data);

        // تعيين رول افتراضي مثلاً
        $admin->assignRole('super-admin');

        return $admin;
    }

    public function login(array $credentials)
    {
        $admin = $this->adminRepository->findByEmail($credentials['email']);

        if (! $admin || ! Hash::check($credentials['password'], $admin->password)) {
            return null;
        }

        return $admin->createToken('admin_token')->plainTextToken;
    }

    public function profile(int $id)
    {
        return $this->adminRepository->findById($id);
    }
}
