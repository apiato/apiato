<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Containers\User\Tests\ApiTestCase;

/**
 * Class GetAllUsersTest.
 *
 * @group user
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllClientsTest extends ApiTestCase
{
    protected $endpoint = 'get@v1/clients';

    protected $access = [
        'roles' => '',
        'permissions' => 'list-users',
    ];

    public function testGetAllClientsByAdmin_(): void
    {
        User::factory()->count(1)->create();
        User::factory()->admin()->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        self::assertCount(1, $responseContent->data);
    }

    public function testGetAllClientsByNonAdmin_(): void
    {
        // prepare a user without any roles or permissions
        $this->getTestingUserWithoutAccess();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(403);

        $this->assertResponseContainKeyValue([
            'message' => 'This action is unauthorized.',
        ]);
    }
}
