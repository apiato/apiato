<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ListRolePermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles/{role_id}/permissions';

    public function testGetRolePermissions(): void
    {
        $this->actingAs(User::factory()->admin()->createOne());
        $role = Role::factory()->createOne();
        $permission = Permission::factory()->createOne();
        $role->givePermissionTo([$permission]);

        $response = $this->injectId($role->id, replace: '{role_id}')->makeCall();

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
