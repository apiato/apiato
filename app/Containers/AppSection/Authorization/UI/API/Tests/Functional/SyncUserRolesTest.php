<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Vinkla\Hashids\Facades\Hashids;

/**
 * @group authorization
 * @group api
 */
class SyncUserRolesTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles/sync';

    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => '',
    ];

    public function testSyncMultipleRolesOnUser(): void
    {
        $role1 = Role::factory()->create();
        $role2 = Role::factory()->create();
        $user = User::factory()->create();
        $user->assignRole($role1);
        $data = [
            'roles_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->count('data.roles.data', 2)
                ->where('data.roles.data.0.id', $data['roles_ids'][0])
                ->where('data.roles.data.1.id', $data['roles_ids'][1])
                ->etc()
        );
    }

    public function testSyncRoleOnNonExistingUser(): void
    {
        $role = Role::factory()->create();
        $invalidId = 7777;
        $data = [
            'roles_ids' => [$role->getHashedKey()],
            'user_id' => Hashids::encode($invalidId),
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.user_id.0', 'The selected user id is invalid.')
                ->etc()
        );
    }

    public function testSyncNonExistingRoleOnUser(): void
    {
        $user = User::factory()->create();
        $invalidId = 7777;
        $data = [
            'roles_ids' => [Hashids::encode($invalidId)],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
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
