<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Actions\CreatePermissionAction;
use App\Containers\Authorization\Actions\CreateRoleAction;
use App\Port\Seeder\Abstracts\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * @var  \App\Containers\Authorization\Actions\CreateRoleAction
     */
    private $createRoleAction;

    /**
     * @var  \App\Containers\Authorization\Actions\CreatePermissionAction
     */
    private $createPermissionAction;

    /**
     * RolesAndPermissionsSeeder constructor.
     *
     * @param \App\Containers\Authorization\Actions\CreateRoleAction       $createRoleAction
     * @param \App\Containers\Authorization\Actions\CreatePermissionAction $createPermissionAction
     */
    public function __construct(
        CreateRoleAction $createRoleAction,
        CreatePermissionAction $createPermissionAction
    ) {
        $this->createRoleAction = $createRoleAction;
        $this->createPermissionAction = $createPermissionAction;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Roles ----------------------------------------------------------------
        // ------------------------------------------------------------------------------
        $roleAdmin = $this->createRoleAction->run('admin', 'Super Administrator');
        $roleClient = $this->createRoleAction->run('client', 'Normal Client');
        $roleDeveloper = $this->createRoleAction->run('developer', 'A developer account, has access to the API');

        // Default Permissions ----------------------------------------------------------
        // ------------------------------------------------------------------------------

        $p = $this->createPermissionAction->run('list-all-users', 'List all users in the system');
        $roleAdmin->givePermissionTo($p);

        // ---------------------------------------

        $p = $this->createPermissionAction->run('manage-roles-permissions', 'Manage Roles and Permissions for Users');
        $roleAdmin->givePermissionTo($p);

        // ---------------------------------------
        $p = $this->createPermissionAction->run('delete-user');
        $roleAdmin->givePermissionTo($p);

        // ---------------------------------------

        $p = $this->createPermissionAction->run('update-user');
        $roleClient->givePermissionTo($p);
        $roleAdmin->givePermissionTo($p);

        // ---------------------------------------

        $p = $this->createPermissionAction->run('create-applications',
            'Create Application to gain third party access using special token');
        $roleDeveloper->givePermissionTo($p);

        // ---------------------------------------

        $p = $this->createPermissionAction->run('list-applications');
        $roleDeveloper->givePermissionTo($p);

        // ---------------------------------------

        // ...

    }
}
