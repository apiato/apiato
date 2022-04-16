<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Class GetAllUsersTest.
 *
 * @group user
 * @group api
 */
class GetAllUsersTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users';

    protected array $access = [
        'permissions' => 'list-users',
        'roles' => '',
    ];

    public function testGetAllUsersByAdmin(): void
    {
        User::factory()->count(2)->create();
        $this->getTestingUserWithoutAccess(createUserAsAdmin: true);

        $response = $this->makeCall();

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data', 4)
                    ->etc()
        );
    }

    public function testGetAllUsersByNonAdmin(): void
    {
        $this->getTestingUserWithoutAccess();
        User::factory()->count(2)->create();

        $response = $this->makeCall();

        $response->assertStatus(403);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('message')
                    ->where('message', 'You are not authorized to request this resource.')
                    ->etc()
        );
    }

    public function testSearchUsersByName(): void
    {
        User::factory()->count(3)->create();
        $user = $this->getTestingUser([
            'name' => 'mahmoudzzz',
        ]);

        $response = $this->endpoint($this->endpoint . "?search=name:" . urlencode($user->name))->makeCall();

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data')
                    ->where('data.0.name', $user->name)
                    ->etc()
        );
    }

    public function testSearchUsersByHashID(): void
    {
        User::factory()->count(3)->create();
        $user = $this->getTestingUser();

        $response = $this->endpoint($this->endpoint . '?search=id:' . $user->getHashedKey())->makeCall();

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data')
                    ->where('data.0.id', $user->getHashedKey())
                    ->etc()
        );
    }
}
