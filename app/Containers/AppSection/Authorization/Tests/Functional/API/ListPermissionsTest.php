<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ListPermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions';

    public function testListPermissions(): void
    {
        $this->actingAs(User::factory()->admin()->createOne());
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
