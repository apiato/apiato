<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Actions\CreateRoleAction;
use App\Port\Seeder\Abstracts\Seeder;

class RolesSeeder extends Seeder
{

    /**
     * @var  \App\Containers\Authorization\Actions\CreateRoleAction
     */
    private $createRoleAction;

    /**
     * RolesSeeder constructor.
     *
     * @param \App\Containers\Authorization\Actions\CreateRoleAction $createRoleAction
     */
    public function __construct(CreateRoleAction $createRoleAction)
    {
        $this->createRoleAction = $createRoleAction;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Roles ----------------------------------------------------------------

        $this->createRoleAction->run('admin', 'Super Administrator')->givePermissionTo([
            'admin-access', 'manage-roles-permissions',
        ]);

        $this->createRoleAction->run('client', 'Normal User');

        // ...

    }
}
