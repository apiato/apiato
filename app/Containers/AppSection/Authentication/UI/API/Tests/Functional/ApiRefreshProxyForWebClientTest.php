<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\Exceptions\RefreshTokenMissingException;
use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * @group authentication
 * @group api
 */
class ApiRefreshProxyForWebClientTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/clients/web/refresh';

    private array $data;

    public function testRequestingRefreshTokenWithoutPassingARefreshTokenShouldThrowAnException(): void
    {
        $data = [];

        $response = $this->makeCall($data);

        $response->assertStatus(400);
        $message = (new RefreshTokenMissingException())->getMessage();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('message')
                ->where('message', $message)
                ->etc()
        );
    }

    public function testGivenRefreshTokenPassedAsParameterItShouldBeString(): void
    {
        $data = [
            'refresh_token' => '', // empty equals `not string`
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.refresh_token.0', 'The refresh token field must be a string.')
                ->etc()
        );
    }

    public function testOnSuccessfulRefreshTokenRequestEnsureValuesAreSetProperly(): void
    {
        $loginResponse = $this->endpoint('post@v1/clients/web/login')->makeCall($this->data);
        $refreshToken = json_decode($loginResponse->getContent(), true, 512, JSON_THROW_ON_ERROR)['refresh_token'];
        $data = [
            'refresh_token' => $refreshToken,
        ];

        $response = $this->endpoint($this->endpoint)->makeCall($data);

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

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'email' => 'testing@mail.com',
            'password' => 'testing_pass',
        ];

        $this->getTestingUser($this->data);
        $this->actingAs($this->testingUser, 'web');
    }
}
