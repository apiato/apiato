<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Actions\CreatePermissionAction;
use App\Port\Seeder\Abstracts\Seeder;

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

        $this->createPermissionAction->run('admin-access', 'General Admin access Permission.');

        $this->createPermissionAction->run('manage-roles-permissions', 'Manage Roles and Permissions.');

        // ...

    }
}
