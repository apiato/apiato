<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Containers\User\Tests\ApiTestCase;

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
        'roles' => 'admin',
        'permissions' => 'list-users',
    ];

    public function testGetAllUsersByAdmin(): void
    {
        // create some non-admin users who are clients
        User::factory()->count(2)->create();

        $response = $this->makeCall();

        $response->assertStatus(200);
        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        self::assertCount(4, $responseContent->data);
    }

    public function testGetAllUsersByNonAdmin(): void
    {
        $this->getTestingUserWithoutAccess();

        // create some fake users
        User::factory()->count(2)->create();

        $response = $this->makeCall();

        $response->assertStatus(403);

        $this->assertResponseContainKeyValue([
            'message' => 'This action is unauthorized.',
        ]);
    }

    public function testSearchUsersByName(): void
    {
        $user = $this->getTestingUser([
            'name' => 'mahmoudzzz'
        ]);

        // 3 random users
        User::factory()->count(3)->create();

        $response = $this->endpoint($this->endpoint . '?search=name:mahmoudzzz')->makeCall();

        $response->assertStatus(200);
        $responseArray = $response->decodeResponseJson();

        self::assertEquals($user->name, $responseArray['data'][0]['name']);

        // assert only single user was returned
        self::assertCount(1, $responseArray['data']);
    }
}
