<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversNothing]
final class GetUserProfileTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/profile';

    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    public function testGetAuthenticatedUser(): void
    {
        $user = $this->getTestingUser();

        $response = $this->makeCall();

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has(
                'data',
                fn (AssertableJson $json) => $json
                    ->where('object', 'User')
                    ->where('id', $user->getHashedKey())
                    ->where('email', $user->email)
                    ->whereType('email_verified_at', 'string')
                    ->where('name', $user->name)
                    ->where('gender', $user->gender)
                    ->whereType('birth', 'string')
                    ->etc(),
            )->etc(),
        );
    }

    public function testGetAuthenticatedUserByUnauthenticatedUser(): void
    {
        $this->testingUser = UserFactory::new()->createOne();

        $response = $this->auth(false)->makeCall();

        $response->assertUnauthorized();
    }
}
