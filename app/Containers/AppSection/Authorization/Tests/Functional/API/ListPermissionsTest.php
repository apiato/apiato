<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Enums\Role;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ListPermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions';

    protected array $access = [
        'permissions' => null,
        'roles' => Role::SUPER_ADMIN,
    ];

    public function testListPermissions(): void
    {
        Permission::factory()->count(2)->create();

        $response = $this->makeCall();

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json) => $json->has(
                'data',
                2,
            )->etc(),
        );
    }
}
