<?php

namespace Mega\Modules\User\Tests\Api;

use Mega\Services\Core\Test\Abstracts\TestCase;

/**
 * Class RegisterEndpointTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterTest extends TestCase
{

    private $endpoint = '/register';

    public function testRegisterNewUser_()
    {
        $data = [
            'email'    => 'mega@mail.dev',
            'name'     => 'Mega',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $this->assertResponseContainKeyValue([
            'email' => $data['email'],
            'name'  => $data['name'],
        ], $response);

        // assert response contain the correct data
        $this->assertResponseContainKeys(['id', 'token'], $response);

        // assert the data is stored in the database
        $this->seeInDatabase('users', ['email' => $data['email']]);
    }

    public function testRegisterNewUserUsingGetVerb()
    {
        $data = [
            'email'    => 'mega@mail.dev',
            'name'     => 'Mega',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '405');

        // assert response contain the correct message
        $this->assertResponseContainKeyValue([
            'message' => '405 Method Not Allowed',
        ], $response);
    }

    public function testRegisterExistingUser()
    {
        $userDetails = [
            'email'    => 'mega@mail.dev',
            'name'     => 'Mega',
            'password' => 'secret',
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'email'    => $userDetails['email'],
            'name'     => $userDetails['name'],
            'password' => $userDetails['password'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '409');

        // assert response contain the correct message
        $this->assertResponseContainKeyValue([
            'message' => 'Failed creating new User.',
        ], $response);
    }

    public function testRegisterNewUserWithoutEmail()
    {
        $data = [
            'name'     => 'Mega',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '422');

        // assert response contain the correct message
        $this->assertValidationErrorContain($response, [
            'email' => 'The email field is required.',
        ]);
    }

    public function testRegisterNewUserWithoutName()
    {
        $data = [
            'email'    => 'mega@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '422');

        // assert response contain the correct message
        $this->assertValidationErrorContain($response, [
            'name' => 'The name field is required.',
        ]);
    }

    public function testRegisterNewUserWithoutPassword()
    {
        $data = [
            'email' => 'mega@mail.dev',
            'name'  => 'Mega',
        ];

        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '422');

        // assert response contain the correct message
        $this->assertValidationErrorContain($response, [
            'password' => 'The password field is required.',
        ]);
    }

    public function testRegisterNewUserWithInvalidEmail()
    {
        $data = [
            'email'    => 'missing-at.dev',
            'name'     => 'Mega',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '422');

        // assert response contain the correct message
        $this->assertValidationErrorContain($response, [
            'email' => 'The email must be a valid email address.',
        ]);
    }
}
