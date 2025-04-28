<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class AssignRolesToUserTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/users/{user_id}/roles';

    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles'       => null,
    ];

    public function testAssignRoleToUser(): void
    {
        $model = UserFactory::new()->createOne();
        $role = RoleFactory::new()->createOne();
        $data = [
            'role_ids' => [$role->getHashedKey()],
        ];

        $testResponse = $this->injectId($model->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->has('data.roles.data', 1)
                ->where('data.id', $model->getHashedKey())
                ->where('data.roles.data.0.id', $data['role_ids'][0])
                ->etc(),
        );
    }

    public function testAssignManyRolesToUser(): void
    {
        $model = UserFactory::new()->createOne();
        $role1 = RoleFactory::new()->createOne();
        $role2 = RoleFactory::new()->createOne();
        $data = [
            'role_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
        ];

        $testResponse = $this->injectId($model->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->has('data.roles.data', 2)
                ->where('data.id', $model->getHashedKey())
                ->where('data.roles.data.0.id', $data['role_ids'][0])
                ->where('data.roles.data.1.id', $data['role_ids'][1])
                ->etc(),
        );
    }
}
