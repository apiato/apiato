<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Arr;

/**
 * Class AssignUserToRoleTest.
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles/assign?include=roles';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-admins-access',
    ];

    public function testAssignUserToRole(): void
    {
        $randomUser = User::factory()->create();
        $role = Role::factory()->create();
        $data = [
            'roles_ids' => [$role->getHashedKey()],
            'user_id' => $randomUser->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($data['user_id'], $responseContent->data->id);
        self::assertEquals($data['roles_ids'][0], $responseContent->data->roles->data[0]->id);
    }

    public function testAssignUserToManyRoles(): void
    {
        $randomUser = User::factory()->create();
        $role1 = Role::factory()->create();
        $role2 = Role::factory()->create();
        $data = [
            'roles_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
            'user_id' => $randomUser->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertTrue(count($responseContent->data->roles->data) > 1);
        $roleIds = Arr::pluck($responseContent->data->roles->data, 'id');
        self::assertContains($data['roles_ids'][0], $roleIds);
        self::assertContains($data['roles_ids'][1], $roleIds);
    }
}
