<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class GivePermissionsToUserTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/users/{user_id}/permissions';

    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles'       => null,
    ];

    public function testGiveSinglePermission(): void
    {
        $model = UserFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $data = [
            'permission_ids' => [$permission->getHashedKey()],
        ];

        $testResponse = $this->injectId($model->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $model->getHashedKey())
                ->has('data.permissions.data', 1)
                ->where('data.permissions.data.0.object', 'Permission')
                ->where('data.permissions.data.0.id', $permission->getHashedKey())
                ->etc(),
        );
    }

    public function testGiveMultiplePermissions(): void
    {
        $model = UserFactory::new()->createOne();
        $permissionA = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $data = [
            'permission_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];

        $testResponse = $this->injectId($model->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $model->getHashedKey())
                ->has('data.permissions.data', 2)
                ->where('data.permissions.data.0.object', 'Permission')
                ->where('data.permissions.data.0.id', $permissionA->getHashedKey())
                ->where('data.permissions.data.1.id', $permissionB->getHashedKey())
                ->etc(),
        );
    }

    public function testGiveNonExistingPermission(): void
    {
        $model = UserFactory::new()->createOne();
        $invalidId = $this->encode(7777777);
        $data = [
            'permission_ids' => [$invalidId],
        ];

        $testResponse = $this->injectId($model->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertUnprocessable();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'errors',
                static fn (AssertableJson $errors): AssertableJson => $errors->has(
                    'permission_ids.0',
                    static fn (AssertableJson $permissionIds): AssertableJson => $permissionIds->where('0', 'The selected permission_ids.0 is invalid.'),
                )->etc(),
            )->etc(),
        );
    }

    public function testAttachPermissionToNonExistingRole(): void
    {
        $model = PermissionFactory::new()->createOne();
        $invalidId = $this->encode(7777777);
        $data = [
            'permission_ids' => [$model->getHashedKey()],
        ];

        $testResponse = $this->injectId($invalidId, skipEncoding: true, replace: '{user_id}')->makeCall($data);

        $testResponse->assertUnprocessable();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('errors')
                ->where('errors.user_id.0', 'The selected user id is invalid.')
                ->etc(),
        );
    }
}
