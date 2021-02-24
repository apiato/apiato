<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;
use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Config;

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
    protected $endpoint = 'post@v1/roles/revoke';

    protected $access = [
        'roles' => '',
        'permissions' => 'manage-admins-access',
    ];

    public function testRevokeUserFromRole_(): void
    {
        $roleA = Role::factory()->create();

        $randomUser = User::factory()->create();
        $randomUser->assignRole($roleA);

        $data = [
            'roles_ids' => [$roleA->getHashedKey()],
            'user_id' => $randomUser->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['user_id'], $responseContent->data->id);

        $this->assertDatabaseMissing('model_has_roles', [
            'model_id' => $randomUser->id,
            'role_id' => $roleA->id,
        ]);
    }

    public function testRevokeUserFromRoleWithRealId_(): void
    {
        $roleA = Role::factory()->create();

        $randomUser = User::factory()->create();
        $randomUser->assignRole($roleA);

        $data = [
            'roles_ids' => [$roleA->id],
            'user_id' => $randomUser->id,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct. Note: this will return 200 if `HASH_ID=false` in the .env
        if (Config::get('apiato.hash-id')) {
            $response->assertStatus(400);

            $this->assertResponseContainKeyValue([
                'message' => 'Only Hashed ID\'s allowed.',
            ]);
        } else {
            $response->assertStatus(200);
        }

    }

    public function testRevokeUserFromManyRoles_(): void
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

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertDatabaseMissing('model_has_roles', [
            'model_id' => $randomUser->id,
            'role_id' => $roleA->id,
        ]);

        $this->assertDatabaseMissing('model_has_roles', [
            'model_id' => $randomUser->id,
            'role_id' => $roleB->id,
        ]);
    }
}
