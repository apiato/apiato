<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * @group user
 * @group api
 */
class FindUserByIdTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{id}';

    protected array $access = [
        'permissions' => 'search-users',
        'roles' => '',
    ];

    public function testFindUser(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->makeCall();

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json) => $json->has('data')
                    ->where('data.id', \Hashids::encode($user->id))
                    ->etc()
        );
    }

    public function testFindNonExistingUser(): void
    {
        $invalidId = 7777;

        $response = $this->injectId($invalidId)->makeCall([]);

        $response->assertNotFound();
    }

    public function testFindFilteredUserResponse(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->endpoint($this->endpoint . '?filter=email;name')->makeCall();

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                    ->where('data.name', $user->name)
                    ->where('data.email', $user->email)
        );
    }

    public function testFindUserWithRelation(): void
    {
        $user = $this->getTestingUser();
        $user->assignRole(config('appSection-authorization.admin_role'));

        $response = $this->injectId($user->id)->endpoint($this->endpoint . '?include=roles')->makeCall();

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.email', $user->email)
                ->count('data.roles.data', 1)
                ->where('data.roles.data.0.name', config('appSection-authorization.admin_role'))
                ->etc()
        );
    }
}
