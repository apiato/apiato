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
class GetAllClientsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/clients';

    protected array $access = [
        'roles' => '',
        'permissions' => 'list-users',
    ];

    public function testGetAllClientsByAdmin(): void
    {
        User::factory()->count(1)->create();
        User::factory()->admin()->create();

        $response = $this->makeCall();

        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        // 1 + 1 user created though makeCall() method
        self::assertCount(2, $responseContent->data);
    }

    public function testGetAllClientsByNonAdmin(): void
    {
        // prepare a user without any roles or permissions
        $this->getTestingUserWithoutAccess();

        $response = $this->makeCall();

        $response->assertStatus(403);

        $this->assertResponseContainKeyValue([
            'message' => 'This action is unauthorized.',
        ]);
    }
}
