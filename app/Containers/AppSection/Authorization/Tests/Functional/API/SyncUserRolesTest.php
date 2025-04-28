<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class SyncUserRolesTest extends ApiTestCase
{
    protected string $endpoint = 'put@v1/users/{user_id}/roles';

    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles'       => null,
    ];

    public function testSyncMultipleRolesOnUser(): void
    {
        $model = RoleFactory::new()->createOne();
        $role2 = RoleFactory::new()->createOne();
        $user = UserFactory::new()->createOne();
        $user->assignRole($model);

        $data = [
            'role_ids' => [
                $model->getHashedKey(),
                $role2->getHashedKey(),
            ],
        ];

        $testResponse = $this->injectId($user->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->count('data.roles.data', 2)
                ->where('data.roles.data.0.id', $data['role_ids'][0])
                ->where('data.roles.data.1.id', $data['role_ids'][1])
                ->etc(),
        );
    }

    public function testSyncRoleOnNonExistingUser(): void
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

    public function testSyncNonExistingRoleOnUser(): void
    {
        $model = UserFactory::new()->createOne();
        $invalidId = 7777777;
        $data = [
            'role_ids' => [$this->encode($invalidId)],
        ];

        $testResponse = $this->injectId($model->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertUnprocessable();
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
