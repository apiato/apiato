<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Actions\CreatePermissionAction;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class AuthorizationPermissionsSeeder_1
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationPermissionsSeeder_1 extends Seeder
{

    /**
     * @var  \App\Containers\Authorization\Actions\CreatePermissionAction
     */
    private $createPermissionAction;

    /**
     * PermissionsSeeder constructor.
     *
     * @param \App\Containers\Authorization\Actions\CreatePermissionAction $createPermissionAction
     */
    public function __construct(CreatePermissionAction $createPermissionAction)
    {
        $this->createPermissionAction = $createPermissionAction;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Permissions ----------------------------------------------------------

        $this->createPermissionAction->run('manage-roles', 'Create, Update, Delete, List, Attach/detach permissions to Roles and List Permissions.');
        $this->createPermissionAction->run('create-admins', 'Create new Users (Admins) from the dashboard.');
        $this->createPermissionAction->run('manage-admins-access', 'Assign users to Roles.');
        $this->createPermissionAction->run('access-dashboard', 'Access the admins dashboard.');

    }
}
