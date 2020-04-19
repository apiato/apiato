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
        'roles'       => '',
        'permissions' => 'list-users',
    ];

    /**
     * @test
     */
    public function testGetAllClientsByAdmin_()
    {
        // should be returned
        factory(User::class, 3)->states('client')->create();

        // should not be returned
        factory(User::class)->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        $this->assertCount(3, $responseContent->data);
    }

    /**
     * @test
     */
    public function testGetAllClientsByNonAdmin_()
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
