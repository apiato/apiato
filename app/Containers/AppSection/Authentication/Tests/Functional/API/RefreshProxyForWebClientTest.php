<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\RefreshProxyForWebClientController;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RefreshProxyForWebClientController::class)]
final class RefreshProxyForWebClientTest extends ApiTestCase
{
    private string $refreshToken;

    public function testCanRefreshToken(): void
    {
        $response = $this->postJson(action(RefreshProxyForWebClientController::class), [
            'refresh_token' => $this->refreshToken,
        ]);

        $this->assertJsonResponse($response);
    }

    private function assertJsonResponse(TestResponse $response): void
    {
        $response->assertok();
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

    public function testApiCanRefreshViaCookie(): void
    {
        $response = $this
            ->withCredentials()
            ->disableCookieEncryption()
            ->withCookie('refreshToken', $this->refreshToken)
            ->postJson(action(RefreshProxyForWebClientController::class));

        $this->assertJsonResponse($response);
    }

    public function testWebCanRefreshViaCookie(): void
    {
        $response = $this
            ->disableCookieEncryption()
            ->withCookie('refreshToken', $this->refreshToken)
            ->post(action(RefreshProxyForWebClientController::class));

        $this->assertJsonResponse($response);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $data = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        User::factory()->createOne($data);
        $this->refreshToken = User::issueToken(
            AccessTokenProxy::create(
                UserCredential::create(
                    $data['email'],
                    $data['password'],
                ),
                WebClient::fake(),
            ),
        )->refreshToken;
    }
}
