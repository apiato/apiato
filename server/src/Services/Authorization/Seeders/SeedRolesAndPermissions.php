<?php

namespace Mega\Services\Authorization\Seeders;

use Illuminate\Database\Seeder;
use Mega\Services\Authorization\Models\Permission;
use Mega\Services\Authorization\Models\Role;

class SeedRolesAndPermissions extends Seeder
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
