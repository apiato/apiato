<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
final class RevokeUserPermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/users/{id}/permissions';

    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => null,
    ];

    public function testDetachSinglePermissionFromUser(): void
    {
        $user = UserFactory::new()->createOne();
        $permissionA = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $user->givePermissionTo([$permissionA, $permissionB]);

        $data = [
            'permission_ids' => [$permissionA->getHashedKey()],
        ];

        $response = $this->endpoint($this->endpoint . '?include=permissions')->injectId($user->id)->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.permissions.data', 1)
                ->where('data.permissions.data.0.object', 'Permission')
                ->where('data.permissions.data.0.id', $permissionB->getHashedKey())
                ->etc(),
        );
    }

    public function testDetachMultiplePermissionFromUser(): void
    {
        $user = UserFactory::new()->createOne();
        $permissionA = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $permissionC = PermissionFactory::new()->createOne();

        $user->givePermissionTo([$permissionA, $permissionB, $permissionC]);

        $data = [
            'permission_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];

        $response = $this->endpoint($this->endpoint . '?include=permissions')->injectId($user->id)->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $user->getHashedKey())
                ->count('data.permissions.data', 1)
                ->where('data.permissions.data.0.id', $permissionC->getHashedKey())
                ->etc(),
        );
    }

    public function testDetachNonExistingPermissionFromUser(): void
    {
        $invalidId = 3333;
        $user = UserFactory::new()->createOne();
        $data = [
            'permission_ids' => [$this->encode($invalidId)],
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'errors',
                static fn (AssertableJson $errors) => $errors->has(
                    'permission_ids.0',
                    static fn (AssertableJson $permissionIds) => $permissionIds->where(0, 'The selected permission_ids.0 is invalid.'),
                )->etc(),
            )->etc(),
        );
    }
}
