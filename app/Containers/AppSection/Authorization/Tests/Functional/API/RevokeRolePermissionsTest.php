<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class RevokeRolePermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/roles/{role_id}/permissions';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles'       => null,
    ];

    public function testDetachSinglePermissionFromRole(): void
    {
        $model = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $role = RoleFactory::new()->createOne();
        $role->givePermissionTo([$model, $permissionB]);

        $data = [
            'permission_ids' => [$model->getHashedKey()],
        ];

        $testResponse = $this->injectId($role->id, replace: '{role_id}')->makeCall($data);

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.object', 'Role')
                ->where('data.id', $role->getHashedKey())
                ->count('data.permissions.data', 1)
                ->where('data.permissions.data.0.id', $permissionB->getHashedKey())
                ->etc(),
        );
    }

    public function testDetachMultiplePermissionFromRole(): void
    {
        $model = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $permissionC = PermissionFactory::new()->createOne();
        $role = RoleFactory::new()->createOne();
        $role->givePermissionTo([$model, $permissionB, $permissionC]);

        $data = [
            'permission_ids' => [$model->getHashedKey(), $permissionC->getHashedKey()],
        ];

        $testResponse = $this->injectId($role->id, replace: '{role_id}')->makeCall($data);

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.object', 'Role')
                ->where('data.id', $role->getHashedKey())
                ->count('data.permissions.data', 1)
                ->where('data.permissions.data.0.id', $permissionB->getHashedKey())
                ->etc(),
        );
    }

    public function testDetachPermissionFromNonExistingRole(): void
    {
        $model = PermissionFactory::new()->createOne();
        $invalidId = 7777777;
        $data = [
            'permission_ids' => [$model->getHashedKey()],
        ];

        $testResponse = $this->injectId($invalidId, replace: '{role_id}')->makeCall($data);

        $testResponse->assertUnprocessable();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('errors')
                ->where('errors.role_id.0', 'The selected role id is invalid.')
                ->etc(),
        );
    }

    public function testDetachNonExistingPermissionFromRole(): void
    {
        $model = RoleFactory::new()->createOne();
        $invalidId = 7777777;
        $data = [
            'permission_ids' => [$this->encode($invalidId)],
        ];

        $testResponse = $this->injectId($model->id, replace: '{role_id}')->makeCall($data);

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
}
