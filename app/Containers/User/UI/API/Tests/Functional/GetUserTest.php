<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\TestCase;

/**
 * Class GetUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserTest extends TestCase
{

    protected $endpoint = '/users/{id}';

    public function testGetUser_()
    {
        $admin = $this->getTestingAdmin();

        // send the HTTP request
        $response = $this->apiCall($this->injectEndpointId($this->endpoint, $admin->id), 'get', [], true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($admin->name, $responseObject->data->name);
    }

}
