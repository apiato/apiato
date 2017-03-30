<?php

namespace App\Containers\User\Data\Seeders;

use App\Containers\Authorization\Actions\CreatePermissionAction;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class UserPermissionsSeeder_1
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UserPermissionsSeeder_1 extends Seeder
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

        $this->createPermissionAction->run('search-users', 'Find a User in the DB.');
        $this->createPermissionAction->run('list-users', 'List all Users.');
        $this->createPermissionAction->run('update-users', 'Update a User.');
        $this->createPermissionAction->run('delete-users', 'Delete a User.');
        $this->createPermissionAction->run('refresh-users', 'Refresh User data.');

        // ...

    }
}
