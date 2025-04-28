<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class RefreshProxyForWebClientTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/clients/web/refresh';

    private array $data;

    public function testProxyRefresh(): void
    {
        $testResponse = $this->endpoint('post@v1/clients/web/login')->makeCall($this->data);
        $refreshToken = json_decode($testResponse->getContent(), true, 512, JSON_THROW_ON_ERROR)['data']['refresh_token'];
        $data = [
            'refresh_token' => $refreshToken,
        ];

        $response = $this->endpoint($this->endpoint)->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'data',
                static fn (AssertableJson $json): AssertableJson => $json->hasAll([
                    'access_token',
                    'refresh_token',
                    'token_type',
                    'expires_in',
                ])->where('token_type', 'Bearer')
                    ->etc(),
            )->etc(),
        );
    }

    public function testGivenRefreshTokenPassedAsParameterItShouldBeString(): void
    {
        $data = [
            'refresh_token' => '', // empty equals `not string`
        ];

        $testResponse = $this->makeCall($data);

        $testResponse->assertUnprocessable();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('errors')
                ->where('errors.refresh_token.0', 'The refresh token field must be a string.')
                ->etc(),
        );
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'email'    => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];

        $this->getTestingUser($this->data);
        $this->actingAs($this->testingUser, 'web');
    }
}
