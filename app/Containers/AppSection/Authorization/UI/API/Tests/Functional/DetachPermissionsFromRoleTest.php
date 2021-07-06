<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\ApiTestCase;

/**
 * Class DetachPermissionsFromRoleTest.
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/permissions/detach';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testDetachSinglePermissionFromRole(): void
    {
        $permissionA = Permission::factory()->create();
        $roleA = Role::factory()->create();
        $roleA->givePermissionTo($permissionA);
        $data = [
            'role_id' => $roleA->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey()],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($roleA->name, $responseContent->data->name);
        $this->assertDatabaseMissing(config('permission.table_names.role_has_permissions'), [
            'permission_id' => $permissionA->id,
            'role_id' => $roleA->id
        ]);
    }

    public function testDetachMultiplePermissionFromRole(): void
    {
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
        $roleA = Role::factory()->create();
        $roleA->givePermissionTo($permissionA);
        $roleA->givePermissionTo($permissionB);
        $data = [
            'role_id' => $roleA->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($roleA->name, $responseContent->data->name);
        $this->assertDatabaseMissing(config('permission.table_names.role_has_permissions'), [
            'permission_id' => $permissionA->id,
            'permission_id' => $permissionB->id,
            'role_id' => $roleA->id
        ]);
    }
}
