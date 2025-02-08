<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ListUserPermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{user_id}/permissions';

    public function testGetUserPermissions(): void
    {
        $this->actingAs(User::factory()->admin()->createOne());
        $user = User::factory()->createOne();
        $permission = Permission::factory()->createOne();
        $user->givePermissionTo([$permission]);

        $response = $this->injectId($user->id, replace: '{user_id}')->makeCall();

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json) => $json->has(
                'data',
                static fn (AssertableJson $json) => $json->where('0.name', $permission->name)
                ->etc(),
            )->etc(),
        );
    }
}
