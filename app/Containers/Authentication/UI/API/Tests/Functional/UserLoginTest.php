<?php

namespace App\Containers\Authentication\UI\API\Tests\Functional;

use App\Containers\Authentication\Tests\TestCase;

/**
 * Class UserLoginTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserLoginTest extends TestCase
{

    protected $endpoint = 'post@login';

    protected $auth = false;

    public function testUserLoginExistingUser_()
    {
        $userDetails = [
            'email'    => 'apiato@mail.dev',
            'name'     => 'Apiato',
            'password' => 'secret',
        ];

        $this->getTestingUser($userDetails);

        $data = [
            'email'    => $userDetails['email'],
            'password' => $userDetails['password'],
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert the response contain the expected data
        $this->assertResponseContainKeyValue([
            'email' => $userDetails['email'],
            'name'  => $userDetails['name'],
        ]);

        // assert response contain the data
        $this->assertResponseContainKeys(['id', 'token']);
    }

    public function testUserLoginExistingUserUsingGetRequest_()
    {
        $data = [
            'email'    => 'apiato@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->endpoint('get@login')->makeCall($data);

        // assert response status is correct
        $response->assertStatus(405);

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => '405 Method Not Allowed',
        ]);
    }

    public function testUserLoginNonExistingUser_()
    {
        $data = [
            'email'    => 'i-do-not-exist@mail.dev',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(401);

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'Credentials Incorrect.',
        ]);
    }

    public function testUserLoginExistingUserWithoutEmail_()
    {
        $userDetails = [
            'email'    => 'apiato@mail.dev',
            'name'     => 'Apiato',
            'password' => 'secret',
        ];

        $this->getTestingUser($userDetails);

        $data = [
            'password' => $userDetails['password'],
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        // assert message is correct
        $this->assertValidationErrorContain([
            'email' => 'The email field is required.',
        ]);
    }

    public function testUserLoginExistingUserWithoutPassword_()
    {
        $userDetails = [
            'email'    => 'apiato@mail.dev',
            'name'     => 'Apiato',
            'password' => 'secret',
        ];

        $this->getTestingUser($userDetails);

        $data = [
            'email' => $userDetails['email'],
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        // assert message is correct
        $this->assertValidationErrorContain([
            'password' => 'The password field is required.',
        ]);
    }

    public function testUserLoginExistingUserWithoutEmailAndPassword_()
    {
        $userDetails = [
            'email'    => 'apiato@mail.dev',
            'name'     => 'Apiato',
            'password' => 'secret',
        ];

        $this->getTestingUser($userDetails);

        $data = []; // empty data

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        // assert message is correct
        $this->assertValidationErrorContain([
            'email'    => 'The email field is required.',
            'password' => 'The password field is required.',
        ]);
    }
}
