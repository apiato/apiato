<?php

namespace App\Containers\User\Tests\Api;

use App\Engine\Test\Abstracts\TestCase;

/**
 * Class DeleteUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTest extends TestCase
{

    private $endpoint = '/users';

    public function testDeleteExistingUser_()
    {
        $user = $this->getLoggedInTestingUser();

        $data = [
            'name'     => 'Updated Name',
            'password' => 'updated#Password',
        ];

        $endpoint = $this->endpoint . '/' . $user->id;

        // send the HTTP request
        $response = $this->apiCall($endpoint, 'delete', $data);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'User (' . $user->id . ') Deleted Successfully.',
        ], $response);
    }

    public function testDeleteDifferentUser()
    {
        $endpoint = $this->endpoint . '/' . 100; // any ID

        // send the HTTP request
        $response = $this->apiCall($endpoint, 'delete');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '403');

        // assert user not allowed to proceed with the request
        $this->assertEquals($response->getContent(), 'Forbidden');
    }
}
