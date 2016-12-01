<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

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

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'put', $data);

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
        $this->getLoggedInTestingUser();

        $data = []; // empty data

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'put', $data);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '417');

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'Inputs are empty.',
        ], $response);
    }
}
