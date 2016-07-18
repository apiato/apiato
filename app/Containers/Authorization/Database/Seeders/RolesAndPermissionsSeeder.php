<?php

namespace App\Containers\Authorization\Database\Seeders;

use App\Port\Seeder\Abstracts\Seeder;
use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Administrator';
        $admin->save();

        $listUsers = new Permission();
        $listUsers->name = 'list-users';
        $listUsers->display_name = 'List all Users';
        $listUsers->save();

        $admin->attachPermission($listUsers);
    }
}
