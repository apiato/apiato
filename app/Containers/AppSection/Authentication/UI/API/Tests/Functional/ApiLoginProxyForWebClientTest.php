<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * @group authentication
 * @group api
 */
class ApiLoginProxyForWebClientTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/clients/web/login';

    public function testClientWebAdminProxyLogin(): void
    {
        $data = [
            'email' => 'testing@mail.com',
            'password' => 'testingpass',
        ];
        $this->getTestingUser($data);

        $response = $this->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->hasAll([
                'token_type',
                'expires_in',
                'access_token',
            ])->where('token_type', 'Bearer')
                ->etc()
        );
    }

    public function testClientWebAdminProxyLoginWithUppercaseEmail(): void
    {
        $data = [
            'email' => 'Testing@Mail.Com',
            'password' => 'testiness',
        ];
        $this->getTestingUser(['email' => 'testing@mail.com', 'password' => $data['password']]);
        Config::set('appSection-authentication.login.case_sensitive', false);

        $response = $this->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->hasAll([
                'token_type',
                'expires_in',
                'access_token',
            ])->where('token_type', 'Bearer')
                ->etc()
        );
    }

    public function testLoginWithNameAttribute(): void
    {
        $data = [
            'email' => 'testing@mail.com',
            'password' => 'testingpass',
            'name' => 'username',
        ];
        $this->getTestingUser($data);
        $this->setLoginAttributes([
            'email' => [],
            'name' => [],
        ]);
        $request = [
            'password' => 'testingpass',
            'name' => 'username',
        ];

        $response = $this->makeCall($request);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->hasAll([
                'token_type',
                'expires_in',
                'access_token',
                'refresh_token',
            ])->where('token_type', 'Bearer')
                ->etc()
        );
    }

    private function setLoginAttributes(array $attributes): void
    {
        Config::set('appSection-authentication.login.attributes', $attributes);
    }

    public function testGivenOnlyOneLoginAttributeIsSetThenItShouldBeRequired(): void
    {
        $this->setLoginAttributes([
            'email' => [],
        ]);
        $data = [
            'password' => 'so-secret',
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(fn (AssertableJson $json) => $json->has(
            'errors',
            fn (AssertableJson $json) => $json
                ->where('email.0', 'The email field is required.')
        )->etc());
    }

    public function testGivenMultipleLoginAttributeIsSetThenAtLeastOneShouldBeRequired(): void
    {
        $this->setLoginAttributes([
            'email' => [],
            'name' => [],
        ]);
        $data = [
            'password' => 'so-secret',
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(fn (AssertableJson $json) => $json->has(
            'errors',
            fn (AssertableJson $json) => $json
                ->where('email.0', 'The email field is required when none of name are present.')
                ->where('name.0', 'The name field is required when none of email are present.')
        )->etc());
    }

    public function testGivenWrongCredentialThrow422(): void
    {
        $data = [
            'email' => 'none@existing.mail',
            'password' => 'some-unbelievable-password',
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
    }
}
