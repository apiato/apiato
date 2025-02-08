<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class FindUserByIdTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{user_id}';

    public function testCanFindSelfAsAdmin(): void
    {
        $user = User::factory()->admin()->createOne();
        $this->actingAs($user);

        $response = $this->injectId($user->id, replace: '{user_id}')->makeCall();

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.id', $user->getHashedKey())
                ->etc(),
        );
    }
}
