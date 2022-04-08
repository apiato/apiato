<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class SyncPermissionsOnRoleTest.
 *
 * @group authorization
 * @group api
 */
class SyncPermissionsOnRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/permissions/sync';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testSyncDuplicatedPermissionsToRole(): void
    {
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
        $role = Role::factory()->create();
        $role->givePermissionTo($permissionA);
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data')
                    ->where('data.object', 'Role')
                    ->where('data.id', $role->getHashedKey())
                    ->count('data.permissions.data', 2)
                    ->where('data.permissions.data.0.id', $permissionA->getHashedKey())
                    ->where('data.permissions.data.1.id', $permissionB->getHashedKey())
                    ->etc()
        );
    }

    public function testSyncPermissionsOnNonExistingRole(): void
    {
        $permission = Permission::factory()->create();
        $invalidId = 7777;
        $data = [
            'role_id' => Hashids::encode($invalidId),
            'permissions_ids' => [$permission->getHashedKey()],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(404);
    }

    public function testSyncNonExistingPermissionOnRole(): void
    {
        $role = Role::factory()->create();
        $invalidId = 7777;
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => [Hashids::encode($invalidId)],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(404);
    }
}
