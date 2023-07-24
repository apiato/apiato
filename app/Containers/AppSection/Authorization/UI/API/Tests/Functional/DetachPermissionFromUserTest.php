<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Vinkla\Hashids\Facades\Hashids;

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
        $user = User::factory()->create();
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
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
                ->etc()
        );
    }

    public function testDetachMultiplePermissionFromUser(): void
    {
        $user = User::factory()->create();
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
        $permissionC = Permission::factory()->create();

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
                ->etc()
        );
    }

    public function testDetachNonExistingPermissionFromUser(): void
    {
        $invalidId = 3333;
        $user = User::factory()->create();
        $data = [
            'permissions_ids' => [Hashids::encode($invalidId)],
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            static fn (AssertableJson $json) => $json->has(
                'errors',
                static fn (AssertableJson $errors) => $errors->has(
                    'permissions_ids.0',
                    static fn (AssertableJson $permissionsIds) => $permissionsIds->where(0, 'The selected permissions_ids.0 is invalid.')
                )->etc()
            )->etc()
        );
    }

    public function testDetachPermissionFromNonExistingUser(): void
    {
        $invalidId = 3333;
        $permission = Permission::factory()->create();
        $data = [
            'permissions_ids' => [$permission->getHashedKey()],
        ];

        $response = $this->injectId($invalidId)->makeCall($data);

        $response->assertJson(
            static fn (AssertableJson $json) => $json->has(
                'errors',
                static fn (AssertableJson $errors) => $errors->where('id.0', 'The selected id is invalid.')
                    ->etc()
            )->etc()
        );
    }
}
