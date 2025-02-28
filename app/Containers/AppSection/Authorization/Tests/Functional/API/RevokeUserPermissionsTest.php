<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\RevokeUserPermissionsController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeUserPermissionsController::class)]
final class RevokeUserPermissionsTest extends ApiTestCase
{
    public function testDetachSinglePermissionFromUser(): void
    {
        $this->actingAs(User::factory()->superAdmin()->createOne());
        $user = User::factory()->createOne();
        $permissionA = Permission::factory()->createOne();
        $permissionB = Permission::factory()->createOne();
        $user->givePermissionTo([$permissionA, $permissionB]);
        $data = [
            'permission_ids' => [$permissionA->getHashedKey()],
        ];

        $response = $this->deleteJson(action(
            RevokeUserPermissionsController::class,
            ['user_id' => $user->getHashedKey()],
        ), $data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.type', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.permissions.data', 1)
                ->where('data.permissions.data.0.type', 'Permission')
                ->where('data.permissions.data.0.id', $permissionB->getHashedKey())
                ->etc(),
        );
    }

    public function testDetachMultiplePermissionFromUser(): void
    {
        $this->actingAs(User::factory()->superAdmin()->createOne());
        $user = User::factory()->createOne();
        $permissionA = Permission::factory()->createOne();
        $permissionB = Permission::factory()->createOne();
        $permissionC = Permission::factory()->createOne();
        $user->givePermissionTo([$permissionA, $permissionB, $permissionC]);
        $data = [
            'permission_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];

        $response = $this->deleteJson(action(
            RevokeUserPermissionsController::class,
            ['user_id' => $user->getHashedKey()],
        ), $data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.type', 'User')
                ->where('data.id', $user->getHashedKey())
                ->count('data.permissions.data', 1)
                ->where('data.permissions.data.0.id', $permissionC->getHashedKey())
                ->etc(),
        );
    }

    // TODO: move to request test
    public function testGivenUserHasNoAccessPreventsOperation(): void
    {
        $this->actingAs(User::factory()->createOne());

        $response = $this->deleteJson(action(
            RevokeUserPermissionsController::class,
            ['user_id' => User::factory()->createOne()->getHashedKey()],
        ));

        $response->assertForbidden();
    }
}
