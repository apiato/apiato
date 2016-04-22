<?php

namespace Mega\Services\Authorization\Seeders;

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;

class SeedRolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listUsersPermission = Permission::create([
            'name' => 'List users',
            'slug' => 'list.users',
            'description' => 'List all registered Users.',
        ]);

        $createUserPermission = Permission::create([
            'name' => 'Create user',
            'slug' => 'create.user',
            'description' => 'Create a User.',
        ]);

        $updateUserPermission = Permission::create([
            'name' => 'Update user',
            'slug' => 'update.user',
            'description' => 'Update a User.',
        ]);

        $deleteUserPermission = Permission::create([
            'name' => 'Delete user',
            'slug' => 'delete.user',
            'description' => 'Delete a User.',
        ]);

        $adminRole = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Admin access',
            'level' => 1,
        ]);

        $memberRole = Role::create([
            'name' => 'Member',
            'slug' => 'member',
            'description' => 'Member access',
            'level' => 1,
        ]);

        $adminRole->attachPermission($listUsersPermission);
        $adminRole->attachPermission($createUserPermission);
        $adminRole->attachPermission($updateUserPermission);
        $adminRole->attachPermission($deleteUserPermission);

        $memberRole->attachPermission($createUserPermission);
        $memberRole->attachPermission($updateUserPermission);
        $memberRole->attachPermission($deleteUserPermission);

    }
}
