<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\LoginProxyForWebClientController;
use App\Containers\AppSection\Authentication\UI\API\Controllers\RefreshProxyForWebClientController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RefreshProxyForWebClientController::class)]
final class RefreshProxyForWebClientTest extends ApiTestCase
{
    public function testProxyRefresh(): void
    {
        $this->setupPasswordGrantClient();
        $data = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $this->actingAs(User::factory()->createOne($data), 'web');

        $loginResponse = $this->postJson(action(LoginProxyForWebClientController::class), $data);
        $response = $this->postJson(action(RefreshProxyForWebClientController::class), [
            'refresh_token' => $loginResponse['data']['refresh_token'],
        ]);

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

    public function testProxyRefreshViaCookie(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $this->setupPasswordGrantClient();
        $data = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $this->actingAs(User::factory()->createOne($data), 'web');

        $loginResponse = $this->postJson(action(LoginProxyForWebClientController::class), $data);
        $response = $this->postJson(action(RefreshProxyForWebClientController::class))
//            ->cookie('refreshToken', $loginResponse['data']['refresh_token']);
            ->withCookie('refreshToken', $loginResponse['data']['refresh_token']);

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
}
