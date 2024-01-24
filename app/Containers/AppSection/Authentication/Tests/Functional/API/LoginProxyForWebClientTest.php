<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversNothing]
final class LoginProxyForWebClientTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/clients/web/login';

    public function testProxyLogin(): void
    {
        $data = [
            'email' => 'testing@mail.com',
            'password' => 'testingpass',
        ];
        $this->getTestingUser($data);

        $response = $this->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has(
                'data',
                fn (AssertableJson $json) => $json->hasAll([
                'access_token',
                'refresh_token',
                'token_type',
                'expires_in',
            ])->where('token_type', 'Bearer')
                ->etc(),
            )->etc(),
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
    }

    private function setLoginAttributes(array $fields): void
    {
        config()->set('appSection-authentication.login.fields', $fields);
    }

    public function testGivenOnlyOneLoginAttributeIsSetThenItShouldBeRequired(): void
    {
        $this->setLoginAttributes([
            'email' => [],
        ]);
        $data = [
            'password' => 'youShallNotPass',
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(fn (AssertableJson $json) => $json->has(
            'errors',
            fn (AssertableJson $json) => $json
                ->where('email.0', 'The email field is required.'),
        )->etc());
    }

    public function testGivenMultipleLoginAttributeIsSetThenAtLeastOneShouldBeRequired(): void
    {
        $this->setLoginAttributes([
            'email' => [],
            'name' => [],
        ]);
        $data = [
            'password' => 'youShallNotPass',
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(fn (AssertableJson $json) => $json->has(
            'errors',
            fn (AssertableJson $json) => $json
                ->where('email.0', 'The email field is required when none of name are present.')
                ->where('name.0', 'The name field is required when none of email are present.'),
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
