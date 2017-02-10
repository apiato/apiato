<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class RegisterUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterUserTest extends TestCase
{

    protected $endpoint = '/users/register';


    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testRegisterNewUserWithCredentials_()
    {
        $data = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $this->assertResponseContainKeyValue([
            'email' => $data['email'],
            'name'  => $data['name'],
        ], $response);

         // assert response contain the token
        $this->assertResponseContainKeys(['id', 'token'], $response);

         // assert the data is stored in the database
        $this->seeInDatabase('users', ['email' => $data['email']]);
    }

    public function testRegisterNewUserUsingGetVerb()
    {
        $data = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get', $data, false);

        // assert response status is correct
        $this->assertEquals('405', $response->getStatusCode());

        // assert response contain the correct message
        $this->assertResponseContainKeyValue([
            'message' => '405 Method Not Allowed',
        ], $response);
    }

    public function testRegisterExistingUser()
    {
        $userDetails = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // get the logged in user (create one if no one is logged in)
        $this->createTestingUser(null, $userDetails);

        $data = [
            'email'    => $userDetails['email'],
            'name'     => $userDetails['name'],
            'password' => $userDetails['password'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('422', $response->getStatusCode());
    }

    public function testRegisterNewUserWithoutEmail()
    {
        $data = [
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('422', $response->getStatusCode());

        // assert response contain the correct message
        $this->assertValidationErrorContain($response, [
            'email' => 'The email field is required.',
        ]);
    }

    public function testRegisterNewUserWithoutName()
    {
        $data = [
            'email'    => 'hello@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('422', $response->getStatusCode());

        // assert response contain the correct message
        $this->assertValidationErrorContain($response, [
            'name' => 'The name field is required.',
        ]);
    }

    public function testRegisterNewUserWithoutPassword()
    {
        $data = [
            'email' => 'hello@mail.dev',
            'name'  => 'Hello',
        ];

        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('422', $response->getStatusCode());

        // assert response contain the correct message
        $this->assertValidationErrorContain($response, [
            'password' => 'The password field is required.',
        ]);
    }

    public function testRegisterNewUserWithInvalidEmail()
    {
        $data = [
            'email'    => 'missing-at.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals('422', $response->getStatusCode());

        // assert response contain the correct message
        $this->assertValidationErrorContain($response, [
            'email' => 'The email must be a valid email address.',
        ]);
    }
}
