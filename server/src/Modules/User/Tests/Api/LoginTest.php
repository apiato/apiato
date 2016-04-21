<?php

namespace Mega\Modules\User\Tests\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mega\Services\Core\Test\Abstracts\TestCase;

/**
 * Class LoginEndpointTest.
 *
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginTest extends TestCase
{
    use DatabaseMigrations;

    private $endpoint = '/login';

    public function testLoginExistingUser_()
    {
        $name = 'Mega';
        $email = 'mega@mail.dev';
        $password = 'secret';

        $userDetails = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'email' => $email,
            'password' => $password,
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
    }

    public function testLoginExistingUserUsingGetRequest()
    {
        $data = [
            'email' => 'mega@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get', $data, false);

        $this->assertEquals($response->getStatusCode(), '405');

        $this->assertResponseContainKeyValue([
            'message' => '405 Method Not Allowed',
        ], $response);
    }

    public function testLoginNonExistingUser()
    {
        $data = [
            'email' => 'i-do-not-exist@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '401');

        $this->assertResponseContainKeyValue([
            'message' => 'Credentials Incorrect.',
        ], $response);
    }

    public function testLoginExistingUserWithoutEmail_()
    {
        $password = 'secret';

        $userDetails = [
            'name' => 'Mega',
            'email' => 'mega@mail.dev',
            'password' => $password,
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'password' => $password,
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '422');

        $this->assertValidationErrorContain($response, [
            'email' => 'The email field is required.',
        ]);
    }

    public function testLoginExistingUserWithoutPassword()
    {
        $name = 'Mega';
        $email = 'mega@mail.dev';
        $password = 'secret';

        $userDetails = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'email' => $email,
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '422');

        $this->assertValidationErrorContain($response, [
            'password' => 'The password field is required.',
        ]);
    }

    public function testLoginExistingUserWithoutEmailAndPassword()
    {
        $name = 'Mega';
        $email = 'mega@mail.dev';
        $password = 'secret';

        $userDetails = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = [];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '422');

        $this->assertValidationErrorContain($response, [
            'email' => 'The email field is required.',
            'password' => 'The password field is required.',
        ]);
    }
}
