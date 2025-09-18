<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // user guard
        Role::firstOrCreate(['name' => 'basic-user', 'guard_name' => 'user']);
        Permission::firstOrCreate(['name' => 'view-profile', 'guard_name' => 'user']);

        // admin guard
        Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'manage-users', 'guard_name' => 'admin']);
    }
}
