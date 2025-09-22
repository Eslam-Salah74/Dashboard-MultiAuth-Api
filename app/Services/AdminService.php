<?php

namespace App\Services;

use App\Models\Admin;
use App\Repositories\Contracts\AdminRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function create(array $data): Admin
    {
        $data['password'] = Hash::make($data['password']); 
        $admin = $this->adminRepository->create($data);

        $admin->assignRole('super-admin');

        return $admin;
    }

    public function login(array $credentials): ?string
    {
        $admin = $this->adminRepository->findByEmail($credentials['email']);

        if (! $admin || ! Hash::check($credentials['password'], $admin->password)) {
            return null;
        }

        return $admin->createToken('admin-token')->plainTextToken;
    }
}
