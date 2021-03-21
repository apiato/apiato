<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;

/**
 * Class SyncPermissionsOnRoleTest.
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncPermissionsOnRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/permissions/sync';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testSyncDuplicatedPermissionsToRole(): void
    {
        $permissionA = Permission::factory()->create(['display_name' => 'AAA']);
        $permissionB = Permission::factory()->create(['display_name' => 'BBB']);

        $roleA = Role::factory()->create();
        $roleA->givePermissionTo($permissionA);

        $data = [
            'role_id' => $roleA->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()]
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertDatabaseHas('role_has_permissions', [
            'permission_id' => $permissionA->id,
            'permission_id' => $permissionB->id,
            'role_id' => $roleA->id
        ]);
    }
}
