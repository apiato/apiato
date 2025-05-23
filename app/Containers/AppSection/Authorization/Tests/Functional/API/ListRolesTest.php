<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\ListRolesController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ListRolesController::class)]
final class ListRolesTest extends ApiTestCase
{
    public function testListRoles(): void
    {
        $this->actingAs(User::factory()->superAdmin()->createOne());

        $response = $this->getJson(action(ListRolesController::class));

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json) => $json->has(
                'data',
                1,
            )->etc(),
        );
    }

    // TODO: move to request test
    public function testGivenUserHasNoAccessPreventsOperation(): void
    {
        $this->actingAs(User::factory()->createOne());

        $response = $this->getJson(action(ListRolesController::class));

        $response->assertForbidden();
    }
}
