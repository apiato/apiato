<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;

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
        User::factory()->count(2)->create();

        $response = $this->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();

        $this->assertCount(4, $responseContent->data);
    }

    public function testGetAllUsersByNonAdmin(): void
    {
        $this->getTestingUserWithoutAccess();
        User::factory()->count(2)->create();

        $response = $this->makeCall();

        $response->assertStatus(403);
        $this->assertResponseContainKeyValue([
            'message' => 'This action is unauthorized.',
        ]);
    }

    public function testSearchUsersByName(): void
    {
        User::factory()->count(3)->create();
        $user = $this->getTestingUser([
            'name' => 'mahmoudzzz',
        ]);

        $response = $this->endpoint($this->endpoint . '?search=name:' . $user->name)->makeCall();
        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertCount(1, $responseContent->data);
        $this->assertEquals($user->name, $responseContent->data[0]->name);
    }

    public function testSearchUsersByHashID(): void
    {
        User::factory()->count(3)->create();
        $user = $this->getTestingUser();

        $response = $this->endpoint($this->endpoint . '?search=id:' . $user->getHashedKey())->makeCall();
        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertCount(1, $responseContent->data);
        $this->assertEquals($user->getHashedKey(), $responseContent->data[0]->id);
    }
}
