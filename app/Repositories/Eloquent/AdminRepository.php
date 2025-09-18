<?php

namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Services\AdminService;

class AdminRepository implements AdminRepositoryInterface
{
    // protected $adminService;

    // public function __construct(AdminService $adminService)
    // {
    //     $this->adminService = $adminService;
    // }

    // public function create(array $data): Admin
    // {
    //     return Admin::create($data);
    // }

    // public function findByEmail(string $email): ?Admin
    // {
    //     return Admin::where('email', $email)->first();
    // }

    // public function findById(int $id): ?Admin
    // {
    //     return Admin::find($id);
    // }

    public function create(array $data): Admin
    {
        return Admin::create($data);
    }

    public function findByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }

    public function findById(int $id): ?Admin
    {
        return Admin::find($id);
    }
}