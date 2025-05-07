<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\AssignRolesToUserController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AssignRolesToUserController::class)]
final class AssignRolesToUserTest extends ApiTestCase
{
    public function testAssignRoleToUser(): void
    {
        $user = User::factory()->superAdmin()->createOne();
        $this->actingAs($user);
        $role = Role::factory()->createOne();
        $data = [
            'role_ids' => [$role->getHashedKey()],
        ];

        $response = $this->patchJson(action(
            AssignRolesToUserController::class,
            ['user_id' => $user->getHashedKey()],
        ), $data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->has('data.roles.data', 3)
                ->etc(),
        );
    }

    public function testAssignManyRolesToUser(): void
    {
        $user = User::factory()->superAdmin()->createOne();
        $this->actingAs($user);
        $role1 = Role::factory()->createOne();
        $role2 = Role::factory()->createOne();
        $data = [
            'role_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
        ];

        $response = $this->patchJson(action(
            AssignRolesToUserController::class,
            ['user_id' => $user->getHashedKey()],
        ), $data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->has('data.roles.data', 4)
                ->etc(),
        );
    }

    // TODO: move to request test
    public function testGivenUserHasNoAccessPreventsOperation(): void
    {
        $this->actingAs(User::factory()->createOne());

        $response = $this->patchJson(action(
            AssignRolesToUserController::class,
            ['user_id' => User::factory()->createOne()->getHashedKey()],
        ));

        $response->assertForbidden();
    }
}
