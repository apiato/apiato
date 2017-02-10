<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Actions\CreateRoleAction;
use App\Containers\Authorization\Tasks\ListAllPermissionsTask;
use App\Port\Seeder\Abstracts\Seeder;

/**
 * Class AuthorizationRolesSeeder_2
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationRolesSeeder_2 extends Seeder
{

    /**
     * @var  \App\Containers\Authorization\Tasks\ListAllPermissionsTask
     */
    private $listAllPermissionsTask;

    /**
     * @var  \App\Containers\Authorization\Actions\CreateRoleAction
     */
    private $createRoleAction;

    /**
     * AuthorizationRolesSeeder_2 constructor.
     *
     * @param \App\Containers\Authorization\Actions\CreateRoleAction     $createRoleAction
     * @param \App\Containers\Authorization\Tasks\ListAllPermissionsTask $listAllPermissionsTask
     */
    public function __construct(CreateRoleAction $createRoleAction, ListAllPermissionsTask $listAllPermissionsTask)
    {
        $this->createRoleAction = $createRoleAction;
        $this->listAllPermissionsTask = $listAllPermissionsTask;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Roles ----------------------------------------------------------------

        // give the super admin all the available permissions, while seeding
        $this->createRoleAction->run('admin', 'Administrator')->givePermissionTo(
            $this->listAllPermissionsTask->run()->pluck('name')->toArray()
        );

        $this->createRoleAction->run('client', 'Normal User');

        // ...

    }
}
