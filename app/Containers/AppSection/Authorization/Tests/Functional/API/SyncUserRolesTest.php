<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
final class SyncUserRolesTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles/sync';

    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => null,
    ];

    public function testSyncMultipleRolesOnUser(): void
    {
        $role1 = RoleFactory::new()->createOne();
        $role2 = RoleFactory::new()->createOne();
        $user = UserFactory::new()->createOne();
        $user->assignRole($role1);
        $data = [
            'role_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->endpoint($this->endpoint . '?include=roles')->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->count('data.roles.data', 2)
                ->where('data.roles.data.0.id', $data['role_ids'][0])
                ->where('data.roles.data.1.id', $data['role_ids'][1])
                ->etc(),
        );
    }

    public function testSyncRoleOnNonExistingUser(): void
    {
        $role = RoleFactory::new()->createOne();
        $invalidId = 7777777;
        $data = [
            'role_ids' => [$role->getHashedKey()],
            'user_id' => $this->encode($invalidId),
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('errors')
                ->where('errors.user_id.0', 'The selected user id is invalid.')
                ->etc(),
        );
    }

    public function testSyncNonExistingRoleOnUser(): void
    {
        $user = UserFactory::new()->createOne();
        $invalidId = 7777777;
        $data = [
            'role_ids' => [$this->encode($invalidId)],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'errors',
                static fn (AssertableJson $errors) => $errors->has(
                    'role_ids.0',
                    static fn (AssertableJson $permissionIds) => $permissionIds->where(0, 'The selected role_ids.0 is invalid.'),
                )->etc(),
            )->etc(),
        );
    }
}
