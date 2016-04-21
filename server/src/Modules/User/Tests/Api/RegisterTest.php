<?php

namespace Mega\Modules\User\Tests\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mega\Services\Core\Test\Abstracts\TestCase;

/**
 * Class RegisterEndpointTest.
 *
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    private $endpoint = '/register';

    public function testRegisterNewUser_()
    {
        $email = 'mega@mail.dev';
        $name = 'Mega';

        $data = [
            'email' => $email,
            'name' => $name,
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $this->assertResponseContainKeyValue([
            'email' => $email,
            'name' => $name,
        ], $response);

        $this->assertResponseContainKeys(['id', 'token'], $response);

        $this->seeInDatabase('users', ['email' => $email]);
    }

    public function testRegisterNewUserUsingGetVerb()
    {
        $data = [
            'email' => 'mega@mail.dev',
            'name' => 'Mega',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '405');

        $this->assertResponseContainKeyValue([
            'message' => '405 Method Not Allowed',
        ], $response);
    }

    public function testRegisterExistingUser()
    {
        $email = 'mega@mail.dev';
        $name = 'Mega';
        $password = 'secret';

        $userDetails = [
            'email' => $email,
            'name' => $name,
            'password' => $password,
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'email' => $email,
            'name' => $name,
            'password' => $password,
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '409');

        $this->assertResponseContainKeyValue([
            'message' => 'Failed creating new User.',
        ], $response);
    }

    public function testRegisterNewUserWithoutEmail()
    {
        $data = [
            'name' => 'Mega',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        $this->assertEquals($response->getStatusCode(), '422');

        $this->assertValidationErrorContain($response, [
            'email' => 'The email field is required.',
        ]);
    }

    public function testRegisterNewUserWithoutName()
    {
        $data = [
            'email' => 'mega@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        $this->assertEquals($response->getStatusCode(), '422');

        $this->assertValidationErrorContain($response, [
            'name' => 'The name field is required.',
        ]);
    }

    public function testRegisterNewUserWithoutPassword()
    {
        $data = [
            'email' => 'mega@mail.dev',
            'name' => 'Mega',
        ];

        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        $this->assertEquals($response->getStatusCode(), '422');

        $this->assertValidationErrorContain($response, [
            'password' => 'The password field is required.',
        ]);
    }

    public function testRegisterNewUserWithInvalidEmail()
    {
        $data = [
            'email' => 'missing-at.dev',
            'name' => 'Mega',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        $this->assertEquals($response->getStatusCode(), '422');

        $this->assertValidationErrorContain($response, [
            'email' => 'The email must be a valid email address.',
        ]);
    }
}
