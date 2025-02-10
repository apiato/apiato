<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class AssignRolesToUserTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/users/{user_id}/roles';

    public function testAssignRoleToUser(): void
    {
        $user = User::factory()->admin()->createOne();
        $role = Role::factory()->createOne();
        $data = [
            'role_ids' => [$role->getHashedKey()],
        ];

        $response = $this->actingAs($user)->injectId($user->id, replace: '{user_id}')->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->has('data.roles.data', 3)
                ->etc(),
        );
    }

    public function testAssignManyRolesToUser(): void
    {
        $user = User::factory()->admin()->createOne();
        $role1 = Role::factory()->createOne();
        $role2 = Role::factory()->createOne();
        $data = [
            'role_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
        ];

        $response = $this->actingAs($user)->injectId($user->id, replace: '{user_id}')->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->has('data.roles.data', 4)
                ->etc(),
        );
    }

    public function testGivenUserHasNoAccessPreventsOperation(): void
    {
        $this->actingAs(User::factory()->createOne());

        $response = $this->makeCall();

        $response->assertForbidden();
    }
}
