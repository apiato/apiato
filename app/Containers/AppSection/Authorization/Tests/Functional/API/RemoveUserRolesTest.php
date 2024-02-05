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
final class RemoveUserRolesTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles/revoke';

    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => null,
    ];

    public function testRevokeRolesFromUser(): void
    {
        $roleA = RoleFactory::new()->createOne();
        $roleB = RoleFactory::new()->createOne();
        $user = UserFactory::new()->createOne();
        $user->assignRole($roleA, $roleB);
        $data = [
            'role_ids' => [$roleA->getHashedKey()],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->endpoint($this->endpoint . '?include=roles')->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $data['user_id'])
                ->has('data.roles.data', 1)
                ->where('data.roles.data.0.id', $roleB->getHashedKey())
                ->etc(),
        );
    }

    public function testRevokeManyRolesFromUser(): void
    {
        $roleA = RoleFactory::new()->createOne();
        $roleB = RoleFactory::new()->createOne();
        $user = UserFactory::new()->createOne();
        $user->assignRole($roleA);
        $user->assignRole($roleB);

        $data = [
            'role_ids' => [$roleA->getHashedKey(), $roleB->getHashedKey()],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->endpoint($this->endpoint . '?include=roles')->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $data['user_id'])
                ->has('data.roles.data', 0)
                ->etc(),
        );
    }

    public function testRevokeRolesFromNonExistingUser(): void
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

    public function testRevokeNonExistingRoleFromUser(): void
    {
        $user = UserFactory::new()->createOne();
        $invalidId = 7777777;
        $data = [
            'role_ids' => [$this->encode($invalidId)],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

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
