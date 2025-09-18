<?php

namespace App\Repositories\Contracts;

use App\Models\Admin;

interface AdminRepositoryInterface
{
    public function create(array $data): Admin;
    public function findByEmail(string $email): ?Admin;
    public function findById(int $id): ?Admin;
}