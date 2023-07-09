<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * @group authentication
 * @group api
 */
class GetAuthenticatedUserTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/profile';

    protected array $access = [
        'permissions' => '',
        'roles' => '',
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
                    ->etc()
            )->etc()
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
                    ->etc()
            )->etc()
        );
    }

    public function testGetAuthenticatedUserByUnauthenticatedUser(): void
    {
        $this->testingUser = User::factory()->create();

        $response = $this->auth(false)->makeCall();

        $response->assertUnauthorized();
    }
}
