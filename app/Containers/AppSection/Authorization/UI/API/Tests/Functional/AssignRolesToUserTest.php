<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Class AssignRolesToUserTest.
 *
 * @group authorization
 * @group api
 */
class AssignRolesToUserTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles/assign?include=roles';

    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => '',
    ];

    public function testAssignRoleToUser(): void
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $data = [
            'roles_ids' => [$role->getHashedKey()],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->has('data.roles.data', 1)
                ->where('data.id', $data['user_id'])
                ->where('data.roles.data.0.id', $data['roles_ids'][0])
                ->etc()
        );
    }

    public function testAssignManyRolesToUser(): void
    {
        $user = User::factory()->create();
        $role1 = Role::factory()->create();
        $role2 = Role::factory()->create();
        $data = [
            'roles_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->has('data.roles.data', 2)
                ->where('data.id', $data['user_id'])
                ->where('data.roles.data.0.id', $data['roles_ids'][0])
                ->where('data.roles.data.1.id', $data['roles_ids'][1])
                ->etc()
        );
    }
}
