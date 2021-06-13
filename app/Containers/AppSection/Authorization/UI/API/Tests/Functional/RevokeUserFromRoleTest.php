<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;

/**
 * Class RevokeUserFromRoleTest.
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles/revoke';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-admins-access',
    ];

    public function testRevokeUserFromRole(): void
    {
        $roleA = Role::factory()->create();
        $randomUser = User::factory()->create();
        $randomUser->assignRole($roleA);
        $data = [
            'roles_ids' => [$roleA->getHashedKey()],
            'user_id' => $randomUser->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($data['user_id'], $responseContent->data->id);
        $this->assertDatabaseMissing(config('permission.table_names.model_has_roles'), [
            'model_id' => $randomUser->id,
            'role_id' => $roleA->id,
        ]);
    }

    public function testRevokeUserFromManyRoles(): void
    {
        $roleA = Role::factory()->create();
        $roleB = Role::factory()->create();
        $randomUser = User::factory()->create();
        $randomUser->assignRole($roleA);
        $randomUser->assignRole($roleB);

        $data = [
            'roles_ids' => [$roleA->getHashedKey(), $roleB->getHashedKey()],
            'user_id' => $randomUser->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $this->assertDatabaseMissing(config('permission.table_names.model_has_roles'), [
            'model_id' => $randomUser->id,
            'role_id' => $roleA->id,
        ]);
        $this->assertDatabaseMissing(config('permission.table_names.model_has_roles'), [
            'model_id' => $randomUser->id,
            'role_id' => $roleB->id,
        ]);
    }
}
