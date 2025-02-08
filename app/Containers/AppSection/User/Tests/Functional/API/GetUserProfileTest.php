<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class GetUserProfileTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/profile';

    public function testCanGetOwnProfile(): void
    {
        $user = User::factory()->createOne();
        $this->actingAs($user);

        $response = $this->makeCall();

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'data',
                static fn (AssertableJson $json): AssertableJson => $json
                    ->where('object', 'User')
                    ->where('id', $user->getHashedKey())
                    ->where('email', $user->email)
                    ->whereType('email_verified_at', 'string')
                    ->where('name', $user->name)
                    ->where('gender', $user->gender->value)
                    ->whereType('birth', 'string')
                    ->etc(),
            )->etc(),
        );
    }

    public function testCannotGetProfileByUnauthenticatedUser(): void
    {
        $response = $this->makeCall();

        $response->assertUnauthorized();
    }
}
