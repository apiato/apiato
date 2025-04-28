<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class RemoveUserRolesTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/users/{user_id}/roles';

    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles'       => null,
    ];

    public function testRevokeRolesFromUser(): void
    {
        $model = RoleFactory::new()->createOne();
        $roleB = RoleFactory::new()->createOne();
        $user = UserFactory::new()->createOne();
        $user->assignRole($model, $roleB);

        $data = [
            'role_ids' => [$model->getHashedKey()],
        ];

        $testResponse = $this->injectId($user->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.roles.data', 1)
                ->where('data.roles.data.0.id', $roleB->getHashedKey())
                ->etc(),
        );
    }

    public function testRevokeManyRolesFromUser(): void
    {
        $model = RoleFactory::new()->createOne();
        $roleB = RoleFactory::new()->createOne();
        $user = UserFactory::new()->createOne();
        $user->assignRole($model);
        $user->assignRole($roleB);

        $data = [
            'role_ids' => [$model->getHashedKey(), $roleB->getHashedKey()],
        ];

        $testResponse = $this->injectId($user->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.roles.data', 0)
                ->etc(),
        );
    }

    public function testRevokeRolesFromNonExistingUser(): void
    {
        $model = RoleFactory::new()->createOne();
        $invalidId = 7777777;
        $data = [
            'role_ids' => [$model->getHashedKey()],
        ];

        $testResponse = $this->injectId($invalidId, replace: '{user_id}')->makeCall($data);

        $testResponse->assertUnprocessable();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('errors')
                ->where('errors.user_id.0', 'The selected user id is invalid.')
                ->etc(),
        );
    }

    public function testRevokeNonExistingRoleFromUser(): void
    {
        $model = UserFactory::new()->createOne();
        $invalidId = 7777777;
        $data = [
            'role_ids' => [$this->encode($invalidId)],
        ];

        $testResponse = $this->injectId($model->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'errors',
                static fn (AssertableJson $errors): AssertableJson => $errors->has(
                    'role_ids.0',
                    static fn (AssertableJson $permissionIds): AssertableJson => $permissionIds->where('0', 'The selected role_ids.0 is invalid.'),
                )->etc(),
            )->etc(),
        );
    }
}
