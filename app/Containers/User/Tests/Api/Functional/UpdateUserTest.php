<?php

namespace App\Containers\User\Tests\Api\Functional;

use App\Kernel\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class UpdateUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserTest extends TestCase
{

    private $endpoint = '/users';

    public function testUpdateExistingUser_()
    {
        $user = $this->getLoggedInTestingUser();

        $data = [
            'name'     => 'Updated Name',
            'password' => 'updated#Password',
        ];

        $endpoint = $this->endpoint . '/' . $user->id;

        // send the HTTP request
        $response = $this->apiCall($endpoint, 'put', $data);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        // assert returned user is the updated one
        $this->assertResponseContainKeyValue([
            'email' => $user->email,
            'name'  => $data['name'],
        ], $response);

        // assert data was updated in the database
        $this->seeInDatabase('users', ['name' => $data['name']]);
    }

    public function testUpdateExistingUserWithEmptyValues()
    {
        $user = $this->getLoggedInTestingUser();

        $data = []; // empty data

        $endpoint = $this->endpoint . '/' . $user->id;

        // send the HTTP request
        $response = $this->apiCall($endpoint, 'put', $data);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '417');

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'All inputs are empty.',
        ], $response);
    }

    public function testUpdateDifferentUser_()
    {
        $data = [
            'name'     => 'Updated Name',
            'password' => 'updated#Password',
        ];

        $endpoint = $this->endpoint . '/' . 100; // amy ID

        // send the HTTP request
        $response = $this->apiCall($endpoint, 'put', $data);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '403');

        // assert the message means (not allowed to proceed with the request)
        $this->assertEquals($response->getContent(), 'Forbidden');
    }
}
