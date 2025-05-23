<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\UI\API\Controllers\ListUsersController;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ListUsersController::class)]
final class ListUsersTest extends ApiTestCase
{
    public function testCanIndexUsersAsAdmin(): void
    {
        $this->actingAs(User::factory()->superAdmin()->createOne());
        User::factory()->count(2)->create();

        $response = $this->getJson(action(ListUsersController::class));

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data', 4)
                ->etc(),
        );
    }

    // TODO: move to request test
    public function testGivenUserHasNoAccessPreventsOperation(): void
    {
        $this->actingAs(User::factory()->createOne());

        $response = $this->getJson(action(ListUsersController::class));

        $response->assertForbidden();
    }
}
