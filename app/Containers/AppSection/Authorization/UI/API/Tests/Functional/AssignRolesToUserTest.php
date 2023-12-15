<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;

/**
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
        $user = UserFactory::new()->createOne();
        $role = RoleFactory::new()->createOne();
        $data = [
            'roles_ids' => [$role->getHashedKey()],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->has('data.roles.data', 1)
                ->where('data.id', $data['user_id'])
                ->where('data.roles.data.0.id', $data['roles_ids'][0])
                ->etc(),
        );
    }

    public function testAssignManyRolesToUser(): void
    {
        $user = UserFactory::new()->createOne();
        $role1 = RoleFactory::new()->createOne();
        $role2 = RoleFactory::new()->createOne();
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
                ->has('data.roles.data', 2)
                ->where('data.id', $data['user_id'])
                ->where('data.roles.data.0.id', $data['roles_ids'][0])
                ->where('data.roles.data.1.id', $data['roles_ids'][1])
                ->etc(),
        );
    }
}
