<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\GivePermissionsToUserController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GivePermissionsToUserController::class)]
final class GivePermissionsToUserTest extends ApiTestCase
{
    public function testGiveSinglePermission(): void
    {
        $user = User::factory()->superAdmin()->createOne();
        $this->actingAs($user);
        $permission = Permission::factory()->createOne();
        $data = [
            'permission_ids' => [$permission->getHashedKey()],
        ];

        $response = $this->postJson(action(GivePermissionsToUserController::class, ['user_id' => $user->getHashedKey()]), $data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.type', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.permissions.data', 1)
                ->where('data.permissions.data.0.type', 'Permission')
                ->where('data.permissions.data.0.id', $permission->getHashedKey())
                ->etc(),
        );
    }

    public function testGiveMultiplePermissions(): void
    {
        $user = User::factory()->superAdmin()->createOne();
        $this->actingAs($user);
        $permissionA = Permission::factory()->createOne();
        $permissionB = Permission::factory()->createOne();
        $data = [
            'permission_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];

        $response = $this->postJson(action(GivePermissionsToUserController::class, ['user_id' => $user->getHashedKey()]), $data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.type', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.permissions.data', 2)
                ->where('data.permissions.data.0.type', 'Permission')
                ->where('data.permissions.data.0.id', $permissionA->getHashedKey())
                ->where('data.permissions.data.1.id', $permissionB->getHashedKey())
                ->etc(),
        );
    }

    // TODO: move to request test
    public function testGivenUserHasNoAccessPreventsOperation(): void
    {
        $this->actingAs(User::factory()->createOne());

        $response = $this->postJson(action(GivePermissionsToUserController::class, ['user_id' => User::factory()->createOne()->getHashedKey()]));

        $response->assertForbidden();
    }
}
