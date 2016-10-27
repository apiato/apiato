<?php

namespace App\Containers\Authentication\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class UserLoginTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserLoginTest extends TestCase
{

    private $endpoint = '/user/login';

    public function testUserLoginExistingUser_()
    {
        $userDetails = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'email'    => $userDetails['email'],
            'password' => $userDetails['password'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        // assert the response contain the expected data
        $this->assertResponseContainKeyValue([
            'email' => $userDetails['email'],
            'name'  => $userDetails['name'],
        ], $response);

        // assert response contain the data
        $this->assertResponseContainKeys(['id', 'token'], $response);
    }

    public function testUserLoginExistingUserUsingGetRequest()
    {
        $data = [
            'email'    => 'hello@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '405');

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => '405 Method Not Allowed',
        ], $response);
    }

    public function testUserLoginNonExistingUser()
    {
        $data = [
            'email'    => 'i-do-not-exist@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '401');

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'Credentials Incorrect.',
        ], $response);
    }

    public function testUserLoginExistingUserWithoutEmail_()
    {
        $userDetails = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'password' => $userDetails['password'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '422');

        // assert message is correct
        $this->assertValidationErrorContain($response, [
            'email' => 'The email field is required.',
        ]);
    }

    public function testUserLoginExistingUserWithoutPassword()
    {
        $userDetails = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'email' => $userDetails['email'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '422');

        // assert message is correct
        $this->assertValidationErrorContain($response, [
            'password' => 'The password field is required.',
        ]);
    }

    public function testUserLoginExistingUserWithoutEmailAndPassword()
    {
        $userDetails = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = []; // empty data

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '422');

        // assert message is correct
        $this->assertValidationErrorContain($response, [
            'email'    => 'The email field is required.',
            'password' => 'The password field is required.',
        ]);
    }
}
