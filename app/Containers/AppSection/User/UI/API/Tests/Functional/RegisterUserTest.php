<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Class RegisterUserTest.
 *
 * @group user
 * @group api
 */
class RegisterUserTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/register';

    protected bool $auth = false;

    protected array $access = [
        'roles' => '',
        'permissions' => '',
    ];

    public function testRegisterNewUserWithCredentials(): void
    {
        $data = [
            'email' => 'apiato@mail.test',
            'password' => 'secretpass',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data')
                    ->where('data.email', $data['email'])
                    ->etc()
        );
    }

    public function testRegisterNewUserUsingGetVerb(): void
    {
        $data = [
            'email' => 'apiato@mail.test',
            'password' => 'secret',
        ];

        $response = $this->endpoint('get@v1/register')->makeCall($data);

        $response->assertStatus(405);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('message')
                ->where('message', 'The GET method is not supported for this route. Supported methods: POST.')
                ->etc()
        );
    }

    public function testRegisterExistingUser(): void
    {
        $userDetails = [
            'email' => 'apiato@mail.test',
            'password' => 'secret',
        ];

        $this->getTestingUser($userDetails);

        $data = [
            'email' => $userDetails['email'],
            'password' => $userDetails['password'],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('errors')
                ->where('errors.email.0', 'The email has already been taken.')
                ->etc()
        );
    }

    public function testRegisterNewUserWithoutData(): void
    {
        $data = [];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('errors')
                ->where('errors.email.0', 'The email field is required.')
                ->where('errors.password.0', 'The password field is required.')
                ->etc()
        );
    }

    public function testRegisterNewUserWithInvalidEmail(): void
    {
        $data = [
            'email' => 'missing-at.test',
            'password' => 'secret',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('errors')
                ->where('errors.email.0', 'The email must be a valid email address.')
                ->etc()
        );
    }
}
