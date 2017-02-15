<?php

namespace App\Containers\Authentication\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class UserLoginTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserLoginTest extends TestCase
{

    protected $endpoint = '/login';

    public function testUserLoginExistingUser_()
    {
        $userDetails = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        $this->createTestingUser(null, $userDetails);

        $data = [
            'email'    => $userDetails['email'],
            'password' => $userDetails['password'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        // assert the response contain the expected data
        $this->assertResponseContainKeyValue([
            'email' => $userDetails['email'],
            'name'  => $userDetails['name'],
        ], $response);

        // assert response contain the data
        $this->assertResponseContainKeys(['id', 'token'], $response);
    }

    public function testUserLoginExistingUserUsingGetRequest_()
    {
        $data = [
            'email'    => 'hello@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get', $data, false);

        // assert response status is correct
        $this->assertEquals('405', $response->getStatusCode());

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => '405 Method Not Allowed',
        ], $response);
    }

    public function testUserLoginNonExistingUser_()
    {
        $data = [
            'email'    => 'i-do-not-exist@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('401', $response->getStatusCode());

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

        $this->createTestingUser(null, $userDetails);

        $data = [
            'password' => $userDetails['password'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('422', $response->getStatusCode());

        // assert message is correct
        $this->assertValidationErrorContain($response, [
            'email' => 'The email field is required.',
        ]);
    }

    public function testUserLoginExistingUserWithoutPassword_()
    {
        $userDetails = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        $this->createTestingUser(null, $userDetails);

        $data = [
            'email' => $userDetails['email'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('422', $response->getStatusCode());

        // assert message is correct
        $this->assertValidationErrorContain($response, [
            'password' => 'The password field is required.',
        ]);
    }

    public function testUserLoginExistingUserWithoutEmailAndPassword_()
    {
        $userDetails = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        $this->createTestingUser(null, $userDetails);

        $data = []; // empty data

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('422', $response->getStatusCode());

        // assert message is correct
        $this->assertValidationErrorContain($response, [
            'email'    => 'The email field is required.',
            'password' => 'The password field is required.',
        ]);
    }
}
