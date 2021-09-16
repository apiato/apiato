<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit;

use App\Containers\AppSection\Authorization\Actions\GiveAllPermissionsToRoleAction;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\TestCase;

/**
 * Class GiveAllPermissionsToRoleActionTest.
 *
 * @group authorization
 * @group unit
 */
class GiveAllPermissionsToRoleActionTest extends TestCase
{
    public function testGiveAllPermissionsToRole(): void
    {
        $role = Role::factory()->create();
        $allPermissionsNames = app(GiveAllPermissionsToRoleAction::class)->run($role->name);

        $this->assertTrue($role->hasAllPermissions($allPermissionsNames));
    }
}
