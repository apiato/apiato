<?php

namespace App\Containers\AppSection\Authorization\UI\CLI\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Containers\AppSection\Authorization\Tests\CliTestCase;

/**
 * Class GiveAllPermissionsToRoleTest.
 *
 * @group authorization
 * @group cli
 */
class GiveAllPermissionsToRoleTest extends CliTestCase
{
    public function testGiveAllPermissionsToRole(): void
    {
        $roleName = Role::factory()->create()->name;
        $allPermissionsNames = app(GetAllPermissionsTask::class)->run(true)->pluck('name')->toArray();

        $this->artisan("apiato:permissions:toRole ${roleName}")
            ->expectsOutput("Gave the Role (${roleName}) the following Permissions: " . implode(
                ' - ',
                $allPermissionsNames
            ) . '.')
            ->assertExitCode(0);
    }
}
