<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $data = Arr::only($data, ['name','email','password']);
        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);

        // assign default role (ensure role exists)
        $user->assignRole('basic-user');

        return $user;
    }

    public function login(array $credentials)
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return null;
        }

        return $user->createToken('user_token')->plainTextToken;
    }

    public function profile(int $id)
    {
        return $this->userRepository->findById($id);
    }
}
