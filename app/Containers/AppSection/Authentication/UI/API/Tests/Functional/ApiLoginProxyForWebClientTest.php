<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;
use Illuminate\Support\Facades\Config;

/**
 * Class ApiLoginProxyForWebClientTest
 *
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

        $response->assertStatus(200);
        $this->assertResponseContainKeyValue([
            'token_type' => 'Bearer',
        ]);
        $this->assertResponseContainKeys(['expires_in', 'access_token']);
    }

    public function testClientWebAdminProxyLoginWithUppercaseEmail(): void
    {
        $data = [
            'email' => 'Testing@Mail.Com',
            'password' => 'testiness',
        ];
        $this->getTestingUser(['email' => 'testing@mail.com', 'password' => $data['password'],]);
        Config::set('appSection-authentication.login.case_sensitive', false);

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $this->assertResponseContainKeyValue([
            'token_type' => 'Bearer',
        ]);
        $this->assertResponseContainKeys(['expires_in', 'access_token']);
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

        $response->assertStatus(200);
        $this->assertResponseContainKeyValue([
            'token_type' => 'Bearer',
        ]);
        $this->assertResponseContainKeys(['expires_in', 'access_token', 'refresh_token']);
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

        $this->makeCall($data);

        $this->assertValidationErrorContain([
            'email' => 'The email field is required.',
        ]);
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

        $this->makeCall($data);

        $this->assertValidationErrorContain([
            'email' => 'The email field is required when none of name are present.',
            'name' => 'The name field is required when none of email are present.',
        ]);
    }

    public function testGivenWrongCredential_Throw422(): void
    {
        $data = [
            'email' => 'none@existing.mail',
            'password' => 'some-unbelievable-password',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
    }
}
