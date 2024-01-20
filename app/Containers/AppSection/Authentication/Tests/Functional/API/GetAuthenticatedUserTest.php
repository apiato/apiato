<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversNothing]
class GetAuthenticatedUserTest extends ApiTestCase
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

    public function testGetAuthenticatedUserAsAdmin(): void
    {
        $user = $this->getTestingUser(createUserAsAdmin: true);

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
                    ->where('real_id', $user->id)
                    ->whereType('created_at', 'string')
                    ->whereType('updated_at', 'string')
                    ->where('readable_created_at', $user->created_at->diffForHumans())
                    ->where('readable_updated_at', $user->updated_at->diffForHumans())
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
