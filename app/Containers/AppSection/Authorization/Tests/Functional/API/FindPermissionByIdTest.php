<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class FindPermissionByIdTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions/{permission_id}';

    public function testFindPermissionById(): void
    {
        $this->actingAs(User::factory()->admin()->createOne());
        $permission = Permission::factory()->createOne();

        $response = $this->injectId($permission->id, replace: '{permission_id}')->makeCall();

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json) => $json->has(
                'data',
                static fn (AssertableJson $json) => $json->where('name', $permission->name)
                    ->etc(),
            )->etc(),
        );
    }
}
