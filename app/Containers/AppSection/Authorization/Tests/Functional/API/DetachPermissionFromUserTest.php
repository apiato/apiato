<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * @group authorization
 * @group api
 */
class DetachPermissionFromUserTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/users/{id}/permissions';

    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => '',
    ];

    public function testDetachSinglePermissionFromUser(): void
    {
        $user = UserFactory::new()->createOne();
        $permissionA = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $user->givePermissionTo([$permissionA, $permissionB]);

        $data = [
            'permissions_ids' => [$permissionA->getHashedKey()],
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json) => $json->has('data')
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
            'permissions_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json) => $json->has('data')
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
            'permissions_ids' => [$this->encode($invalidId)],
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            static fn (AssertableJson $json) => $json->has(
                'errors',
                static fn (AssertableJson $errors) => $errors->has(
                    'permissions_ids.0',
                    static fn (AssertableJson $permissionsIds) => $permissionsIds->where(0, 'The selected permissions_ids.0 is invalid.'),
                )->etc(),
            )->etc(),
        );
    }

    public function testDetachPermissionFromNonExistingUser(): void
    {
        $invalidId = 3333;
        $permission = PermissionFactory::new()->createOne();
        $data = [
            'permissions_ids' => [$permission->getHashedKey()],
        ];

        $response = $this->injectId($invalidId)->makeCall($data);

        $response->assertJson(
            static fn (AssertableJson $json) => $json->has(
                'errors',
                static fn (AssertableJson $errors) => $errors->where('id.0', 'The selected id is invalid.')
                    ->etc(),
            )->etc(),
        );
    }
}
