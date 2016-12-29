<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Port\Seeder\Abstracts\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Roles -------------------------
        // ---------------------------------------

        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->description = 'Super Administrator';
        $adminRole->save();

        // ---------------------------------------

        // ...

        // Default Permissions -------------------
        // ---------------------------------------

        $permission = new Permission();
        $permission->name = 'access-dashboard';
        $permission->description = 'Access the Admins Dashboard';
        $permission->save();

        $adminRole->givePermissionTo($permission);

        // ---------------------------------------

        $permission = new Permission();
        $permission->name = 'list-all-users';
        $permission->description = 'List all users in the system';
        $permission->save();

        $adminRole->givePermissionTo($permission);

        // ---------------------------------------

        $permission = new Permission();
        $permission->name = 'delete-user';
        $permission->description = 'Delete any user';
        $permission->save();

        $adminRole->givePermissionTo($permission);

        // ---------------------------------------

        // ...

    }
}
