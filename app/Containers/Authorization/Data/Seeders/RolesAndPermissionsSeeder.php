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
        // Default Roles ----------------------------------------------------------------
        // ------------------------------------------------------------------------------

        $roleAdmin = Role::create([
            'name'         => 'admin',
            'description'  => 'Super Administrator',
            'display_name' => '',
        ]);

        $roleClient = Role::create([
            'name'         => 'client',
            'description'  => 'Normal User',
            'display_name' => '',
        ]);

        // Default Permissions ----------------------------------------------------------
        // ------------------------------------------------------------------------------

        $p = Permission::create([
            'name'         => 'list-all-users',
            'description'  => 'List all users in the system',
            'display_name' => '',
        ]);

        $roleAdmin->givePermissionTo($p);

        // ---------------------------------------

        $p = Permission::create([
            'name'         => 'delete-user',
            'description'  => '',
            'display_name' => '',
        ]);

        $roleAdmin->givePermissionTo($p);

        // ---------------------------------------

        $p = Permission::create([
            'name'         => 'update-user',
            'description'  => '',
            'display_name' => '',
        ]);

        $roleClient->givePermissionTo($p);
        $roleAdmin->givePermissionTo($p);

        // ---------------------------------------

        // ...

    }
}
