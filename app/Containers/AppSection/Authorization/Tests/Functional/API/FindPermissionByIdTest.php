<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Enums\Role;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class FindPermissionByIdTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions/{permission_id}';

    protected array $access = [
        'permissions' => null,
        'roles' => Role::SUPER_ADMIN,
    ];

    public function testFindPermissionById(): void
    {
        $permissionA = Permission::factory()->createOne();

        $response = $this->injectId($permissionA->id, replace: '{permission_id}')->makeCall();

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json) => $json->has(
                'data',
                static fn (AssertableJson $json) => $json->where('name', $permissionA->name)
                    ->etc(),
            )->etc(),
        );
    }

    public function testFindNonExistingPermission(): void
    {
        $invalidId = 7777777;

        $response = $this->injectId($invalidId, replace: '{permission_id}')->makeCall();

        $response->assertNotFound();
    }
}
