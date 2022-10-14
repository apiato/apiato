<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class RevokeRolesFromUserTest.
 *
 * @group authorization
 * @group api
 */
class RevokeRolesFromUserTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles/revoke';

    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => '',
    ];

    public function testRevokeRolesFromUser(): void
    {
        $roleA = Role::factory()->create();
        $roleB = Role::factory()->create();
        $user = User::factory()->create();
        $user->assignRole($roleA, $roleB);
        $data = [
            'roles_ids' => [$roleA->getHashedKey()],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $data['user_id'])
                ->has('data.roles.data', 1)
                ->where('data.roles.data.0.id', $roleB->getHashedKey())
                ->etc()
        );
    }

    public function testRevokeManyRolesFromUser(): void
    {
        $roleA = Role::factory()->create();
        $roleB = Role::factory()->create();
        $user = User::factory()->create();
        $user->assignRole($roleA);
        $user->assignRole($roleB);

        $data = [
            'roles_ids' => [$roleA->getHashedKey(), $roleB->getHashedKey()],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $data['user_id'])
                ->has('data.roles.data', 0)
                ->etc()
        );
    }

    public function testRevokeRolesFromNonExistingUser(): void
    {
        $role = Role::factory()->create();
        $invalidId = 7777;
        $data = [
            'roles_ids' => [$role->getHashedKey()],
            'user_id' => Hashids::encode($invalidId),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.user_id.0', 'The selected user id is invalid.')
                ->etc()
        );
    }

    public function testRevokeNonExistingRoleFromUser(): void
    {
        $user = User::factory()->create();
        $invalidId = 7777;
        $data = [
            'roles_ids' => [Hashids::encode($invalidId)],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertJson(
            fn (AssertableJson $json) => $json->has(
                'errors',
                fn (AssertableJson $errors) => $errors->has(
                    'roles_ids.0',
                    fn (AssertableJson $permissionsIds) => $permissionsIds->where(0, 'The selected roles_ids.0 is invalid.')
                )->etc()
            )->etc()
        );
    }
}
